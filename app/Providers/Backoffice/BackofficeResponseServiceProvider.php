<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;

// Contracts
use App\Contracts\Responses\Backoffice\ListAdminResponseContract;
use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;
// Responses
use App\Http\Responses\Backoffice\ListAdminResponse;
use App\Http\Responses\Backoffice\ListBannerResponse;
use App\Http\Responses\Backoffice\ListCategoryGroupResponse;
use App\Http\Responses\Backoffice\ListCategoryResponse;
use App\Http\Responses\Backoffice\StoreAdminResponses;
use App\Http\Responses\Backoffice\StoreBannerResponses;
use App\Http\Responses\Backoffice\StoreCategoryGroupResponses;
use App\Http\Responses\Backoffice\StoreCategoryResponses;
use App\Http\Responses\Backoffice\StoreRoleResponses;
use App\Http\Responses\Backoffice\UpdateAdminResponses;
use App\Http\Responses\Backoffice\UpdateBannerResponses;
use App\Http\Responses\Backoffice\UpdateCategoryGroupResponses;
use App\Http\Responses\Backoffice\UpdateCategoryResponses;
use App\Http\Responses\Backoffice\UpdateRoleResponses;

class BackofficeResponseServiceProvider extends ServiceProvider
{
    public $singletons = [
        // Admins
        StoreAdminResponseContract::class => StoreAdminResponses::class,
        UpdateAdminResponseContract::class => UpdateAdminResponses::class,
        ListAdminResponseContract::class  => ListAdminResponse::class,

        // Banners
        StoreBannerResponseContract::class => StoreBannerResponses::class,
        UpdateBannerResponseContract::class => UpdateBannerResponses::class,
        ListBannerResponseContract::class => ListBannerResponse::class,

        // Category Groups
        StoreCategoryGroupResponseContract::class => StoreCategoryGroupResponses::class,
        UpdateCategoryGroupResponseContract::class => UpdateCategoryGroupResponses::class,
        ListCategoryGroupResponseContract::class => ListCategoryGroupResponse::class,

        // Categories
        StoreCategoryResponseContract::class => StoreCategoryResponses::class,
        UpdateCategoryResponseContract::class => UpdateCategoryResponses::class,
        ListCategoryResponseContract::class => ListCategoryResponse::class,

        // Roles
        StoreRoleResponseContract::class => StoreRoleResponses::class,
        UpdateRoleResponseContract::class => UpdateRoleResponses::class,
    ];
}
