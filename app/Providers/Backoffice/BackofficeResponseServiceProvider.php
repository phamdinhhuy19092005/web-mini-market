<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;

// Contracts
use App\Contracts\Responses\Backoffice\ListAdminResponseContract;
use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryResponseContract;
use App\Contracts\Responses\Backoffice\ListCountryResponseContract;
use App\Contracts\Responses\Backoffice\ListCurrencyResponseContract;
use App\Contracts\Responses\Backoffice\ListFaqResponseContract;
use App\Contracts\Responses\Backoffice\ListFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\ListPageResponseContract;
use App\Contracts\Responses\Backoffice\ListPostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\ListPostResponseContract;
use App\Contracts\Responses\Backoffice\ListShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreFaqResponseContract;
use App\Contracts\Responses\Backoffice\StoreFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\StorePageResponseContract;
use App\Contracts\Responses\Backoffice\StorePostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StorePostResponseContract;
use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Contracts\Responses\Backoffice\StoreShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePageResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostResponseContract;
use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingZoneResponseContract;
// Responses
use App\Http\Responses\Backoffice\ListAdminResponse;
use App\Http\Responses\Backoffice\ListBannerResponse;
use App\Http\Responses\Backoffice\ListCategoryGroupResponse;
use App\Http\Responses\Backoffice\ListCategoryResponse;
use App\Http\Responses\Backoffice\ListCountryResponse;
use App\Http\Responses\Backoffice\ListCurrencyResponse;
use App\Http\Responses\Backoffice\ListFaqResponse;
use App\Http\Responses\Backoffice\ListFaqTopicResponse;
use App\Http\Responses\Backoffice\ListPageResponse;
use App\Http\Responses\Backoffice\ListPostCategoryResponse;
use App\Http\Responses\Backoffice\ListPostResponse;
use App\Http\Responses\Backoffice\ListShippingZoneResponse;
use App\Http\Responses\Backoffice\StoreAdminResponses;
use App\Http\Responses\Backoffice\StoreBannerResponses;
use App\Http\Responses\Backoffice\StoreCategoryGroupResponses;
use App\Http\Responses\Backoffice\StoreCategoryResponses;
use App\Http\Responses\Backoffice\StoreFaqResponses;
use App\Http\Responses\Backoffice\StoreFaqTopicResponses;
use App\Http\Responses\Backoffice\StorePageResponses;
use App\Http\Responses\Backoffice\StorePostCategoryResponses;
use App\Http\Responses\Backoffice\StorePostResponses;
use App\Http\Responses\Backoffice\StoreRoleResponses;
use App\Http\Responses\Backoffice\StoreShippingZoneResponses;
use App\Http\Responses\Backoffice\UpdateAdminResponses;
use App\Http\Responses\Backoffice\UpdateBannerResponses;
use App\Http\Responses\Backoffice\UpdateCategoryGroupResponses;
use App\Http\Responses\Backoffice\UpdateCategoryResponses;
use App\Http\Responses\Backoffice\UpdateFaqResponses;
use App\Http\Responses\Backoffice\UpdateFaqTopicResponses;
use App\Http\Responses\Backoffice\UpdatePageResponses;
use App\Http\Responses\Backoffice\UpdatePostCategoryResponses;
use App\Http\Responses\Backoffice\UpdatePostResponses;
use App\Http\Responses\Backoffice\UpdateRoleResponses;
use App\Http\Responses\Backoffice\UpdateShippingZoneResponses;

class BackofficeResponseServiceProvider extends ServiceProvider
{
    public $singletons = [

        /*
        |--------------------------------------------------------------------------
        | Admins
        |--------------------------------------------------------------------------
        */
        StoreAdminResponseContract::class            => StoreAdminResponses::class,
        UpdateAdminResponseContract::class           => UpdateAdminResponses::class,
        ListAdminResponseContract::class             => ListAdminResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Banners
        |--------------------------------------------------------------------------
        */
        StoreBannerResponseContract::class           => StoreBannerResponses::class,
        UpdateBannerResponseContract::class          => UpdateBannerResponses::class,
        ListBannerResponseContract::class            => ListBannerResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Category Groups
        |--------------------------------------------------------------------------
        */
        StoreCategoryGroupResponseContract::class    => StoreCategoryGroupResponses::class,
        UpdateCategoryGroupResponseContract::class   => UpdateCategoryGroupResponses::class,
        ListCategoryGroupResponseContract::class     => ListCategoryGroupResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        StoreCategoryResponseContract::class         => StoreCategoryResponses::class,
        UpdateCategoryResponseContract::class        => UpdateCategoryResponses::class,
        ListCategoryResponseContract::class          => ListCategoryResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        StoreRoleResponseContract::class             => StoreRoleResponses::class,
        UpdateRoleResponseContract::class            => UpdateRoleResponses::class,

        /*
        |--------------------------------------------------------------------------
        | Post Categories
        |--------------------------------------------------------------------------
        */
        StorePostCategoryResponseContract::class     => StorePostCategoryResponses::class,
        UpdatePostCategoryResponseContract::class    => UpdatePostCategoryResponses::class,
        ListPostCategoryResponseContract::class      => ListPostCategoryResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Posts
        |--------------------------------------------------------------------------
        */
        StorePostResponseContract::class             => StorePostResponses::class,
        UpdatePostResponseContract::class            => UpdatePostResponses::class,
        ListPostResponseContract::class              => ListPostResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */
        StorePageResponseContract::class             => StorePageResponses::class,
        UpdatePageResponseContract::class            => UpdatePageResponses::class,
        ListPageResponseContract::class              => ListPageResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Faq Topics
        |--------------------------------------------------------------------------
        */
        StoreFaqTopicResponseContract::class         => StoreFaqTopicResponses::class,
        UpdateFaqTopicResponseContract::class        => UpdateFaqTopicResponses::class,
        ListFaqTopicResponseContract::class          => ListFaqTopicResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Faqs
        |--------------------------------------------------------------------------
        */
        StoreFaqResponseContract::class         => StoreFaqResponses::class,
        UpdateFaqResponseContract::class        => UpdateFaqResponses::class,
        ListFaqResponseContract::class          => ListFaqResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Countries
        |--------------------------------------------------------------------------
        */
        ListCountryResponseContract::class          => ListCountryResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Currencies
        |--------------------------------------------------------------------------
        */
        ListCurrencyResponseContract::class          => ListCurrencyResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Zones
        |--------------------------------------------------------------------------
        */
        StoreShippingZoneResponseContract::class         => StoreShippingZoneResponses::class,
        UpdateShippingZoneResponseContract::class        => UpdateShippingZoneResponses::class,
        ListShippingZoneResponseContract::class          => ListShippingZoneResponse::class,

    ];
}
