<?php

namespace App\Providers\Frontend;

use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(FrontendRouteServiceProvider::class);
    }

    public function boot()
    {
        
    }
}