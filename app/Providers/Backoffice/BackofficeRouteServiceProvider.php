<?php

namespace App\Providers\Backoffice;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class BackofficeRouteServiceProvider extends ServiceProvider
{
    /**
     * Controller namespace for backoffice routes.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Backoffice';

    /**
     * Home path for backoffice.
     *
     * @var string
     */
    public const HOME = '/backoffice';

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the backoffice.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware(['web', 'auth:admin'])
            ->prefix('backoffice')
            ->namespace($this->namespace)
            ->as('bo.web.')
            ->group(base_path('routes/backoffice/web.php'));
    }

    /**
     * Define the "api" routes for the backoffice.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware(['web', 'auth:admin'])
            ->prefix('api')
            ->namespace($this->namespace)
            ->as('bo.api.')
            ->group(base_path('routes/backoffice/api.php'));
    }
}
