<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {

        parent::boot();
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/frontend/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/frontend/web.php'));
    }
}
