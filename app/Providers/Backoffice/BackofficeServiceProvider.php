<?php

namespace App\Providers\Backoffice;

use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Http\Responses\Backoffice\StoreCategoryGroupResponses;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Http\Responses\Backoffice\ListBannerResponse;
use App\Http\Responses\Backoffice\StoreBannerResponses;
use App\Http\Responses\Backoffice\UpdateBannerResponses;
use App\Http\Responses\Backoffice\UpdateCategoryGroupResponses;


use Illuminate\Support\ServiceProvider;

class BackofficeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(BackofficeRouteServiceProvider::class);
        $this->app->register(BackofficeAuthenticationServiceProvider::class);
        $this->app->register(BackofficeRepositoryServiceProvider::class);
        $this->app->register(BackofficeFormRequestServiceProvider::class);
        $this->app->register(BackofficeResponseServiceProvider::class);
    }

    public function boot()
    {
        //
    }
}
