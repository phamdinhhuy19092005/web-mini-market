<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Enum\UserActionEnum;


class GoogleAuthController extends BaseController
{
    public function redirect()
    {
        // return Socialite::driver('google')->redirect();
        return Socialite::driver('google')->stateless()->redirect();

    }



    public function callback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $frontendLoginUrl = config('FRONTEND_URL', 'http://localhost:3001') . '/login';

        // Tìm user theo google_id
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // Nếu chưa có google_id, kiểm tra email xem user đã tồn tại không
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::logout();
                // Nếu user đã tồn tại nhưng đăng ký bằng form => từ chối, không gán google_id
                return redirect()->away($frontendLoginUrl . '?' . http_build_query([
                    'error' => 'Email này đã được đăng ký bằng form, vui lòng đăng nhập bằng email & mật khẩu.'
                ]));
            } else {
                // Tạo mới user bằng Google
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(16)),
                    'status' => UserActionEnum::ACTIVE,
                    'email_verified_at' => now(),
                    'last_logged_in_at' => now(),
                    'access_channel_type' => 1,
                ]);
            }
        }

        // Kiểm tra trạng thái
        if ($user->status !== UserActionEnum::ACTIVE) {
            return redirect()->away($frontendLoginUrl . '?' . http_build_query([
                'error' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để xác thực.'
            ]));
        }

        // Cập nhật thông tin login
        $user->update([
            'last_logged_in_at' => now(),
            'access_channel_type' => $user->access_channel_type ?? 1,
        ]);

        Auth::login($user);

        $token = $user->createToken('google_login_token')->plainTextToken;

        return redirect()->away(config('FRONTEND_URL', 'http://localhost:3001') . '/login-gg-success?' . http_build_query([
            'token' => $token,
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
        return redirect()->away($frontendLoginUrl . '?' . http_build_query([
            'error' => 'Đăng nhập Google thất bại.'
        ]));
    }
}



}