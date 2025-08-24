<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\SendOrderCreatedEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderCreated::class => [
            SendOrderCreatedEmail::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
