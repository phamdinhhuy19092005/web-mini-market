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
                // Cập nhật login time
                $user->update([
                    'last_logged_in_at' => now(),
                ]);
            }

            Auth::login($user);

            $frontendUrl = config('app.frontend_url', 'http://localhost:3001');
            return redirect()->away($frontendUrl . '/login-gg-success?email=' . urlencode($user->email) . '&name=' . urlencode($user->name) . '&avatar=' . urlencode($user->avatar));

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['login' => 'Đăng nhập Google thất bại.']);
        }
    }
}
