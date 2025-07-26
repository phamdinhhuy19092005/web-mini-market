<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Backoffice\BackofficeServiceProvider;
use App\Providers\Frontend\FrontendServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(BackofficeServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
    }

    public function boot(): void
    {
        Blade::component('backoffice.content-editor', 'content-editor');
    }
}
