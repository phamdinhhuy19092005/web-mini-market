<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        // 👉 Nơi khai báo route mở rộng:
        then: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/frontend/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/frontend/web.php'));
        }
    )
    
    ->withMiddleware(function (Middleware $middleware) {
        // Thêm HandleCors vào nhóm middleware "web" và "api"
        $middleware->appendToGroup('api', HandleCors::class);
        $middleware->appendToGroup('web', HandleCors::class);

        // Alias middleware
    $middleware->alias([
        'force.json' => \App\Http\Middleware\ForceJsonResponse::class,
    ]);

    // Thêm force.json vào nhóm api
    $middleware->appendToGroup('api', 'force.json');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
