<?php

namespace App\Providers\Frontend;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class FrontendRouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers\Frontend';

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->as('fe.web.')
            ->group(base_path('routes/frontend/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('fe/api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->as('fe.api.')
            ->group(base_path('routes/frontend/api.php'), function () {
                dd(Route::getRoutes()->getRoutesByName());
            });
    }
}