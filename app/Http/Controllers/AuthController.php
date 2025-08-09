<?php

namespace App\Http\Controllers;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Firebase\JWT\JWT;
use App\Http\Requests\RegisterRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
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
        //check status
        if($user["status"] != ACTIVE_USER ){
            return response()->json(['error' => 'vui lòng kích hoạt tài khoản!'], 403);
            
        };
        $cartUuid = $request->cookie('cart_uuid');
        if ($cartUuid) {
            $guestCart = Cart::with('items')->where('uuid', $cartUuid)->whereNull('user_id')->first();

            if ($guestCart) {
                $userCart = Cart::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'uuid' => (string) Str::uuid(),
                        'ip_address' => $request->ip(),
                        'currency_code' => $guestCart->currency_code ?? 'VND',
                    ]
                );

                foreach ($guestCart->items as $item) {
                    $existingItem = CartItem::where('cart_id', $userCart->id)
                        ->where('inventory_id', $item->inventory_id)
                        ->first();

                    if ($existingItem) {
                        $existingItem->quantity += $item->quantity;
                        $existingItem->save();
                    } else {
                        $item->cart_id = $userCart->id;
                        $item->save();
                    }
                }

                $guestCart->delete();
            }
        }

        // Tạo access token
        $token = $user->createToken('authToken')->plainTextToken;

        // Trả về response và xóa cookie cart_uuid
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
                'access_channel_type' => $user->access_channel_type ?? null
            ]
        ])->withCookie(cookie('cart_uuid', null, -1)); // Xóa cookie cart_uuid
    }


public function register(RegisterRequest $request)
{
    // Kiểm tra email tồn tại
    if (User::where('email', $request->email)->exists()) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Email đã tồn tại'
        ], 409); // 409 Conflict
    }

    try {
        DB::beginTransaction();

        // Tạo token xác thực email
        $token = Str::random(60);

        // Tạo user
        $user = User::create([
            'name'                => $request->name,
            'email'               => $request->email,
            'password'            => Hash::make($request->password),
            'phone_number'        => $request->phone_number,
            'currency_code'       => 'VND',
            'genders'             => $request->genders,
            'birthday'            => $request->birthday,
            'status'              => 0, // Chưa kích hoạt
            'allow_login'         => 1,
            'access_channel_type' => 2,
            'remember_token'      => $token,
        ]);

        // URL xác thực gửi về FE (ví dụ FE ở cổng 3001)
        $verifyUrl = "http://localhost:3001/verify-email?token={$token}&email=".urlencode($user->email);

        // Gửi email xác thực
        Mail::to($user->email)->send(new VerifyEmail($user, $verifyUrl));

        Auth::login($user);
            // Merge giỏ hàng của khách (nếu có)
            $uuid = $request->cookie('cart_uuid');
            $userCart = null;
            if ($uuid) {
                $guestCart = Cart::where('uuid', $uuid)->whereNull('user_id')->first();
                if ($guestCart) {
                    $userCart = Cart::firstOrCreate(
                        ['user_id' => $user->id],
                        [
                            'ip_address' => $request->ip(),
                            'currency_code' => $guestCart->currency_code ?? 'VND',
                            'uuid' => (string) Str::uuid(),
                        ]
                    );

                    foreach ($guestCart->items as $item) {
                        $existing = $userCart->items()->where('inventory_id', $item->inventory_id)->first();
                        if ($existing) {
                            $existing->quantity += $item->quantity;
                            $existing->total_price = $existing->price * $existing->quantity;
                            $existing->save();
                        } else {
                            // Tạo CartItem mới với uuid mới
                            $userCart->items()->create([
                                'inventory_id' => $item->inventory_id,
                                'quantity' => $item->quantity,
                                'uuid' => (string) Str::uuid(), // Tạo uuid mới
                                'currency_code' => $item->currency_code,
                                'status' => $item->status,
                                'price' => $item->price,
                                'total_price' => $item->total_price,
                                'has_combo' => $item->has_combo,
                                'note' => $item->note ?? null, // Thêm note nếu có
                            ]);
                        }
                    }
                    $guestCart->delete();
                    $userCart->updateTotals();
                }
            }

            DB::commit();

            // Tạo token (nếu dùng Sanctum)
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

    $token = $request->input('token');
    $email = $request->input('email');

    if (!$token || !$email) {
        Log::warning('Thiếu token hoặc email');
        return response()->json([
            'status'  => 'error',
            'message' => 'Thiếu token hoặc email'
        ], 400);
    }

    $user = User::where('email', $email)
        ->where('remember_token', $token)
        ->first();

    if (!$user) {
        Log::warning('Token hoặc email không hợp lệ', [
            'email' => $email,
            'token' => $token
        ]);
        return response()->json([
            'status'  => 'error',
            'message' => 'Token hoặc email không hợp lệ'
        ], 404);
    }

    if ($user->status == 1) {
        Log::info('Tài khoản đã xác thực trước đó', ['email' => $email]);
        return response()->json([
            'status'  => 'success',
            'message' => 'Tài khoản đã được xác thực trước đó'
        ], 200);
    }

    // Cập nhật trạng thái đã kích hoạt
    $user->status = 1;
    $user->email_verified_at = now();
    $user->remember_token = null;
    $user->save();

    Log::info('Xác thực email thành công', ['email' => $email]);

    return response()->json([
        'status'  => 'success',
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


            // $resetUrl = url("/reset-password?token={$token}&email={$user->email}");

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
            'email'    => 'required|email',
            'token'    => 'required',
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
