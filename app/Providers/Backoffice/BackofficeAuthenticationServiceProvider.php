<?php

namespace App\Providers\Backoffice;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserPassword;
use App\Providers\FortifyServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class BackofficeAuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(FortifyServiceProvider::class);
    }

    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserPassword::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetPassword::class);

        Fortify::loginView(function () {
            return view('backoffice.auth.login');
        });

        Fortify::registerView(function () {
            return view('backoffice.auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                
                $admin->last_login_at = now();
                $admin->save();

                return $admin;
            }

            return null;
        });
    }
}
