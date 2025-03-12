<?php

namespace App\Providers\Frontend;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class FrontendRouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers\Frontend';

    public function map() {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    public function mapWebRoutes() 
    {
        Route::namespace($this->namespace)
        ->as('fe.web.')
        ->group(base_path('routes/frontend/web.php'));
    }

    public function mapApiRoutes()
    {

    }
}
