<?php

namespace App\Providers\Backoffice;

use App\Http\Requests\Interfaces\StoreAdminRequestInterface;
use Illuminate\Support\ServiceProvider;

use App\Http\Requests\Interfaces\StoreCategoryGroupRequestInterface;
use App\Http\Requests\Interfaces\UpdateCategoryGroupRequestInterface;
use App\Http\Requests\Interfaces\StoreCategoryRequestInterface;
use App\Http\Requests\Interfaces\UpdateCategoryRequestInterface;

use App\Http\Requests\StoreCategoryGroupRequest;
use App\Http\Requests\UpdateCategoryGroupRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use App\Http\Requests\Interfaces\StoreBannerRequestInterface;
use App\Http\Requests\Interfaces\StoreRoleRequestInterface;
use App\Http\Requests\Interfaces\UpdateAdminRequestInterface;
use App\Http\Requests\Interfaces\UpdateBannerRequestInterface;
use App\Http\Requests\Interfaces\UpdateRoleRequestInterface;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Requests\UpdateRoleRequest;

class BackofficeFormRequestServiceProvider extends ServiceProvider
{
    public $singletons = [
        // Admins
        StoreAdminRequestInterface::class => StoreAdminRequest::class,
        UpdateAdminRequestInterface::class => UpdateAdminRequest::class,
        // Category Groups
        StoreCategoryGroupRequestInterface::class => StoreCategoryGroupRequest::class,
        UpdateCategoryGroupRequestInterface::class => UpdateCategoryGroupRequest::class,

        // Categories
        StoreCategoryRequestInterface::class => StoreCategoryRequest::class,
        UpdateCategoryRequestInterface::class => UpdateCategoryRequest::class,

        // Banners
        StoreBannerRequestInterface::class => StoreBannerRequest::class,
        UpdateBannerRequestInterface::class => UpdateBannerRequest::class,

        // Roles
        StoreRoleRequestInterface::class => StoreRoleRequest::class,
        UpdateRoleRequestInterface::class => UpdateRoleRequest::class,
    ];

}
