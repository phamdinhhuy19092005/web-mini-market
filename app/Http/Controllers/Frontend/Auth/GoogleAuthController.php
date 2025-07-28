<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
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
                    'provider' => 'google',
                ]);
            } else {
                $user->update([
                    'last_logged_in_at' => now(),
                    'provider' => $user->provider ?? 'google',
                ]);
            }

            Auth::login($user);

            $token = $user->createToken('google_login_token')->plainTextToken;

            $frontendUrl = config('app.frontend_url', 'http://localhost:3001');

            return redirect()->away($frontendUrl . '/login-gg-success?' . http_build_query([
                'token' => $token,
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'phone_number' => $user->phone_number,
                'birthday' => $user->birthday,
                'genders' => $user->genders,
                'provider' => $user->provider,
            ]));

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['login' => 'Đăng nhập Google thất bại.']);
        }
    }
}
