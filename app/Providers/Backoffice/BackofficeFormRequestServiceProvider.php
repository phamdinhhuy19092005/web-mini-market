<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;

// Admins
use App\Http\Requests\Interfaces\StoreAdminRequestInterface;
use App\Http\Requests\Interfaces\UpdateAdminRequestInterface;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

// Category Groups
use App\Http\Requests\Interfaces\StoreCategoryGroupRequestInterface;
use App\Http\Requests\Interfaces\UpdateCategoryGroupRequestInterface;
use App\Http\Requests\StoreCategoryGroupRequest;
use App\Http\Requests\UpdateCategoryGroupRequest;

// Categories
use App\Http\Requests\Interfaces\StoreCategoryRequestInterface;
use App\Http\Requests\Interfaces\UpdateCategoryRequestInterface;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

// Banners
use App\Http\Requests\Interfaces\StoreBannerRequestInterface;
use App\Http\Requests\Interfaces\StoreFaqRequestInterface;
use App\Http\Requests\Interfaces\StoreFaqTopicRequestInterface;
use App\Http\Requests\Interfaces\UpdateBannerRequestInterface;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

// Roles
use App\Http\Requests\Interfaces\StoreRoleRequestInterface;
use App\Http\Requests\Interfaces\UpdateRoleRequestInterface;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

// Post Categories
use App\Http\Requests\Interfaces\StorePostCategoryRequestInterface;
use App\Http\Requests\Interfaces\UpdatePostCategoryRequestInterface;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;

// Posts
use App\Http\Requests\Interfaces\StorePostRequestInterface;
use App\Http\Requests\Interfaces\UpdatePostRequestInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

// Pages
use App\Http\Requests\Interfaces\StorePageRequestInterface;
use App\Http\Requests\Interfaces\UpdateFaqRequestInterface;
use App\Http\Requests\Interfaces\UpdateFaqTopicRequestInterface;
use App\Http\Requests\Interfaces\UpdatePageRequestInterface;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\StoreFaqTopicRequest;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\UpdateFaqTopicRequest;
use App\Http\Requests\UpdatePageRequest;

class BackofficeFormRequestServiceProvider extends ServiceProvider
{
    public $singletons = [

        /*
        |--------------------------------------------------------------------------
        | Admins
        |--------------------------------------------------------------------------
        */
        StoreAdminRequestInterface::class         => StoreAdminRequest::class,
        UpdateAdminRequestInterface::class        => UpdateAdminRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Category Groups
        |--------------------------------------------------------------------------
        */
        StoreCategoryGroupRequestInterface::class => StoreCategoryGroupRequest::class,
        UpdateCategoryGroupRequestInterface::class => UpdateCategoryGroupRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        StoreCategoryRequestInterface::class      => StoreCategoryRequest::class,
        UpdateCategoryRequestInterface::class     => UpdateCategoryRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Banners
        |--------------------------------------------------------------------------
        */
        StoreBannerRequestInterface::class        => StoreBannerRequest::class,
        UpdateBannerRequestInterface::class       => UpdateBannerRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        StoreRoleRequestInterface::class          => StoreRoleRequest::class,
        UpdateRoleRequestInterface::class         => UpdateRoleRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Post Categories
        |--------------------------------------------------------------------------
        */
        StorePostCategoryRequestInterface::class  => StorePostCategoryRequest::class,
        UpdatePostCategoryRequestInterface::class => UpdatePostCategoryRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Posts
        |--------------------------------------------------------------------------
        */
        StorePostRequestInterface::class          => StorePostRequest::class,
        UpdatePostRequestInterface::class         => UpdatePostRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */
        StorePageRequestInterface::class          => StorePageRequest::class,
        UpdatePageRequestInterface::class         => UpdatePageRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Faq Topics
        |--------------------------------------------------------------------------
        */
        StoreFaqTopicRequestInterface::class          => StoreFaqTopicRequest::class,
        UpdateFaqTopicRequestInterface::class         => UpdateFaqTopicRequest::class,

         /*
        |--------------------------------------------------------------------------
        | Faqs
        |--------------------------------------------------------------------------
        */
        StoreFaqRequestInterface::class          => StoreFaqRequest::class,
        UpdateFaqRequestInterface::class         => UpdateFaqRequest::class,

        
    ];
}
