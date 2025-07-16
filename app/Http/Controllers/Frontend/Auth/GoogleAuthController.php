<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Enum\AccessChannelEnum;
use App\Enum\UserActionEnum;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Frontend\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends BaseController
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(uniqid()),
            'phone_number' => null,
            'google_id' => $googleUser->id,
            'status' => UserActionEnum::ACTIVE,
            'last_logged_in_at' => now(),
            'email_verified_at' => now(),
            'access_channel_type' => AccessChannelEnum::GOOGLE,
        ]);

        Auth::login($user);

        return redirect()->route('fe.web.home');
    }

}
