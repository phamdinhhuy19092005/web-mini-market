<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use App\Providers\Backoffice\BackofficeServiceProvider;
use App\Providers\Frontend\FrontendServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // dd('OKOK1');
        // Đăng ký CreateNewUser để Laravel biết sử dụng class nào khi tạo user mới
        // $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
        $this->app->register(BackofficeServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

