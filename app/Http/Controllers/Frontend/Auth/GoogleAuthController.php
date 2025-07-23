<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends BaseController
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            // Tìm user theo Google ID
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(), 
                    'password' => bcrypt(Str::random(16)),
                    'status' => 1,
                    'email_verified_at' => now(),
                    'last_logged_in_at' => now(),
                    'access_channel_type' => 1,
                ]);
            } else {
                // Cập nhật login time và provider nếu chưa có
            $user->update([
                'last_logged_in_at' => now(),
                'access_channel_type' => $user->access_channel_type ?? 1, // ✅ thêm dòng này
            ]);
            }

            Auth::login($user);

            $frontendUrl = config('app.frontend_url', 'http://localhost:3001');
            return redirect()->away($frontendUrl . '/login-gg-success?' . http_build_query([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'phone_number' => $user->phone_number,
                'birthday' => $user->birthday,
                'genders' => $user->genders,
                'access_channel_type' => $user->access_channel_type,
            ]));


        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['login' => 'Đăng nhập Google thất bại.']);
        }
    }
}
