<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;

class BackofficeServiceProvider extends ServiceProvider 
{
    public function register()
    {
        $this->app->register(BackofficeRouteServiceProvider::class);
    }

    public function boot()
    {

    }
}
