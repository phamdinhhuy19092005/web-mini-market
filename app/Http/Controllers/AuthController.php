<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Enum\UserActionEnum;

class AuthController extends BaseController
{
    protected function getCartUuidFromRequest(Request $request)
    {
        return $request->cookie('cart_uuid')
            ?? $request->header('X-Cart-UUID')
            ?? $request->input('cart_uuid');
    }

    protected function mergeGuestCartToUserCart(?string $guestUuid, User $user, string $ipAddress)
    {
        if (!$guestUuid) {
            Log::info("No guest cart UUID provided for merge.");
            return null;
        }

        $guestCart = Cart::where('uuid', $guestUuid)->whereNull('user_id')->first();

        if (!$guestCart) {
            Log::info("Guest cart with UUID {$guestUuid} not found or already merged.");
            return null;
        }

        DB::beginTransaction();
        try {
            $userCart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'ip_address' => $ipAddress,
                    'currency_code' => $guestCart->currency_code ?? 'VND',
                    'uuid' => (string) Str::uuid(),
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                ]
            );

            foreach ($guestCart->items as $item) {
                $existing = $userCart->items()->where('inventory_id', $item->inventory_id)->first();
                if ($existing) {
                    $existing->quantity += $item->quantity;
                    $existing->total_price = $existing->price * $existing->quantity;
                    $existing->save();
                } else {
                    $userCart->items()->create([
                        'inventory_id' => $item->inventory_id,
                        'quantity' => $item->quantity,
                        'uuid' => (string) Str::uuid(),
                        'currency_code' => $item->currency_code,
                        'status' => $item->status,
                        'price' => $item->price,
                        'total_price' => $item->total_price,
                        'has_combo' => $item->has_combo ?? 0,
                        'note' => $item->note ?? null,
                    ]);
                }
            }

            $userCart->total_quantity = $userCart->items()->sum('quantity');
            $userCart->total_item = $userCart->items()->count();
            $userCart->total_price = $userCart->items()->sum('total_price');
            $userCart->save();

            $guestCart->delete();

            DB::commit();
            return $userCart;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error merging guest cart: " . $e->getMessage());
            return null;
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Sai email hoặc mật khẩu'], 401);
        }

        if ($user->status !== UserActionEnum::ACTIVE) {
            return response()->json(['error' => 'Vui lòng kích hoạt tài khoản!'], 403);
        }

        Auth::login($user);

        $guestUuid = $this->getCartUuidFromRequest($request);
        $userCart = $this->mergeGuestCartToUserCart($guestUuid, $user, $request->ip());

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'avatar' => $user->avatar ?? null,
                'phone_number' => $user->phone_number ?? null,
                'birthday' => $user->birthday ?? null,
                'genders' => $user->genders ?? null,
                'access_channel_type' => $user->access_channel_type ?? null,
            ],
            'cart' => $userCart ?? null,
        ])->withoutCookie('cart_uuid');
    }

    public function register(RegisterRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email đã tồn tại'], 400);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'currency_code' => 'VND',
                'genders' => $request->genders,
                'birthday' => $request->birthday,
                'status' => 0, // Chưa kích hoạt
                'allow_login' => 1,
                'access_channel_type' => 2,
            ]);

            // Tạo token xác thực email
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            $verifyUrl = "http://localhost:3001/verify-email?token={$token}&email=" . urlencode($user->email);
            Mail::to($user->email)->send(new VerifyEmail($user, $verifyUrl));

            Auth::login($user);

            $guestUuid = $this->getCartUuidFromRequest($request);
            $userCart = $this->mergeGuestCartToUserCart($guestUuid, $user, $request->ip());

            DB::commit();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Register success',
                'data' => $user,
                'cart' => $userCart ?? null,
                'token' => $token,
            ], 201)->withoutCookie('cart_uuid');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Register failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        Log::info('Dữ liệu nhận được từ request:', $request->all());

        $token = urldecode($request->input('token'));
        $email = urldecode($request->input('email'));

        if (!$token || !$email) {
            return response()->json([
                'status' => 'error',
                'message' => 'Thiếu token hoặc email'
            ], 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email không tồn tại'
            ], 404);
        }

        if ($user->status == 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Tài khoản đã được xác thực trước đó'
            ], 200);
        }

        if ($user->remember_token !== $token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token không hợp lệ'
            ], 400);
        }

        $user->status = 1;
        $user->email_verified_at = now();
        $user->remember_token = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Xác thực email thành công'
        ], 200);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email không tồn tại.'
            ], 404);
        }

        try {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            $frontendUrl = "http://localhost:3001/resetPassword";
            $resetUrl = "{$frontendUrl}?token={$token}&email={$user->email}";

            Mail::raw("Click vào link để đặt lại mật khẩu: {$resetUrl}", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Khôi phục mật khẩu');
            });

            return response()->json([
                'message' => 'Email đặt lại mật khẩu đã được gửi.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gửi email thất bại.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('remember_token', $request->token)
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Token hoặc email không hợp lệ.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            $user->password = Hash::make($request->password);
            $user->remember_token = null;
            $user->save();

            DB::commit();

            return response()->json([
                'message' => 'Đặt lại mật khẩu thành công.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Đặt lại mật khẩu thất bại.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}