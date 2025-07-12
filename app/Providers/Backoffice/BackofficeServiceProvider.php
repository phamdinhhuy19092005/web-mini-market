<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;
class BackofficeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(BackofficeRouteServiceProvider::class);
        $this->app->register(BackofficeAuthenticationServiceProvider::class);
        $this->app->register(BackofficeRepositoryServiceProvider::class);
        $this->app->register(BackofficeFormRequestServiceProvider::class);
        $this->app->register(BackofficeResponseServiceProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
