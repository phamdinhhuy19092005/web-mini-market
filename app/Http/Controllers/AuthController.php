<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\DB;

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

        $cartUuid = $request->cookie('cart_uuid');
        if ($cartUuid) {
            $guestCart = Cart::with('items')->where('uuid', $cartUuid)->whereNull('user_id')->first();

            if ($guestCart) {
                $userCart = Cart::firstOrCreate(
                    ['user_id' => $user->id],
                    [
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
            'access_token' => $token,
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
        try {
            DB::beginTransaction();

            $user = User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'phone_number'      => $request->phone_number,
                'currency_code'     => 'VND',
                'genders'           => $request->genders,
                'birthday'          => $request->birthday,
                'status'            => 1,
                'allow_login'       => 1,
                'access_channel_type' => 2,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Register success',
                'data'    => $user,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Register failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
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

            $resetUrl = url("/reset-password?token={$token}&email={$user->email}");

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
