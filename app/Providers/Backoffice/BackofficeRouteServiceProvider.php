<?php

namespace App\Providers\Backoffice;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class BackofficeRouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers\Backoffice';
    public const HOME = '/backoffice';

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    public function mapWebRoutes()
    {
        Route::middleware(['auth:admin'])
            ->prefix('backoffice')
            ->namespace($this->namespace)
            ->as('bo.web.')
            ->group(base_path('routes/backoffice/web.php'));
    }

    public function mapApiRoutes() {}
}
