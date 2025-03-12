<?php

namespace App\Providers\Backoffice;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserPassword;
use App\Providers\FortifyServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Fortify;

class BackofficeAuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(FortifyServiceProvider::class);
    }

    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdatesUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetPassword::class);

        Fortify::loginView(function (){
            return view('backoffice.auth.login');
        });

        Fortify::registerView(function (){
            return view('backoffice.auth.login');
        });
    }
}