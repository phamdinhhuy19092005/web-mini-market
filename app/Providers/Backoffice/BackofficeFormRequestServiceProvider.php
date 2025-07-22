<?php

namespace App\Providers\Backoffice;

use Illuminate\Support\ServiceProvider;

// Admins
use App\Http\Requests\Backoffice\Interfaces\StoreAdminRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeValueRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreAutoDiscountRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAdminRequestInterface;
use App\Http\Requests\Backoffice\StoreAdminRequest;
use App\Http\Requests\Backoffice\UpdateAdminRequest;

// Category Groups
use App\Http\Requests\Backoffice\Interfaces\StoreCategoryGroupRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCategoryGroupRequestInterface;
use App\Http\Requests\Backoffice\StoreCategoryGroupRequest;
use App\Http\Requests\Backoffice\UpdateCategoryGroupRequest;

// Categories
use App\Http\Requests\Backoffice\Interfaces\StoreCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCategoryRequestInterface;
use App\Http\Requests\Backoffice\StoreCategoryRequest;
use App\Http\Requests\Backoffice\UpdateCategoryRequest;

// Banners
use App\Http\Requests\Backoffice\Interfaces\StoreBannerRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreBrandRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreCouponRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreFaqRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreFaqTopicRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreInventoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateBannerRequestInterface;
use App\Http\Requests\Backoffice\StoreBannerRequest;
use App\Http\Requests\Backoffice\UpdateBannerRequest;

// Roles
use App\Http\Requests\Backoffice\Interfaces\StoreRoleRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateRoleRequestInterface;
use App\Http\Requests\Backoffice\StoreRoleRequest;
use App\Http\Requests\Backoffice\UpdateRoleRequest;

// Post Categories
use App\Http\Requests\Backoffice\Interfaces\StorePostCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePostCategoryRequestInterface;
use App\Http\Requests\Backoffice\StorePostCategoryRequest;
use App\Http\Requests\Backoffice\UpdatePostCategoryRequest;

// Posts
use App\Http\Requests\Backoffice\Interfaces\StorePostRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePostRequestInterface;
use App\Http\Requests\Backoffice\StorePostRequest;
use App\Http\Requests\Backoffice\UpdatePostRequest;

// Pages
use App\Http\Requests\Backoffice\Interfaces\StorePageRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StorePaymentOptionRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StorePaymentProviderRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreProductRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreShippingRateRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreShippingZoneRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreSubCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreUserRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAttributeRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAttributeValueRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAutoDiscountRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateBrandRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCouponRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateFaqRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateFaqTopicRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateInventoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePageRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentOptionRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentProviderRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateProductRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateShippingRateRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateShippingZoneRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateSubCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateUserRequestInterface;
use App\Http\Requests\Backoffice\StoreAttributeRequest;
use App\Http\Requests\Backoffice\StoreAttributeValueRequest;
use App\Http\Requests\Backoffice\StoreAutoDiscountRequest;
use App\Http\Requests\Backoffice\StoreBrandRequest;
use App\Http\Requests\Backoffice\StoreCouponRequest;
use App\Http\Requests\Backoffice\StoreFaqRequest;
use App\Http\Requests\Backoffice\StoreFaqTopicRequest;
use App\Http\Requests\Backoffice\StoreInventoryRequest;
use App\Http\Requests\Backoffice\StorePageRequest;
use App\Http\Requests\Backoffice\StorePaymentOptionRequest;
use App\Http\Requests\Backoffice\StorePaymentProviderRequest;
use App\Http\Requests\Backoffice\StoreProductRequest;
use App\Http\Requests\Backoffice\StoreShippingRateRequest;
use App\Http\Requests\Backoffice\StoreShippingZoneRequest;
use App\Http\Requests\Backoffice\StoreSubCategoryRequest;
use App\Http\Requests\Backoffice\StoreUserRequest;
use App\Http\Requests\Backoffice\UpdateAttributeRequest;
use App\Http\Requests\Backoffice\UpdateAttributeValueRequest;
use App\Http\Requests\Backoffice\UpdateAutoDiscountRequest;
use App\Http\Requests\Backoffice\UpdateBrandRequest;
use App\Http\Requests\Backoffice\UpdateCouponRequest;
use App\Http\Requests\Backoffice\UpdateFaqRequest;
use App\Http\Requests\Backoffice\UpdateFaqTopicRequest;
use App\Http\Requests\Backoffice\UpdateInventoryRequest;
use App\Http\Requests\Backoffice\UpdatePageRequest;
use App\Http\Requests\Backoffice\UpdatePaymentOptionRequest;
use App\Http\Requests\Backoffice\UpdatePaymentProviderRequest;
use App\Http\Requests\Backoffice\UpdateProductRequest;
use App\Http\Requests\Backoffice\UpdateShippingRateRequest;
use App\Http\Requests\Backoffice\UpdateShippingZoneRequest;
use App\Http\Requests\Backoffice\UpdateSubCategoryRequest;
use App\Http\Requests\Backoffice\UpdateUserRequest;

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
        |Sub Categories
        |--------------------------------------------------------------------------
        */
        StoreSubCategoryRequestInterface::class      => StoreSubCategoryRequest::class,
        UpdateSubCategoryRequestInterface::class     => UpdateSubCategoryRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Banners
        |--------------------------------------------------------------------------
        */
        StoreBannerRequestInterface::class        => StoreBannerRequest::class,
        UpdateBannerRequestInterface::class       => UpdateBannerRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */
        StoreBrandRequestInterface::class        => StoreBrandRequest::class,
        UpdateBrandRequestInterface::class       => UpdateBrandRequest::class,


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

        /*
        |--------------------------------------------------------------------------
        | Shipping Zones
        |--------------------------------------------------------------------------
        */
        StoreShippingZoneRequestInterface::class          => StoreShippingZoneRequest::class,
        UpdateShippingZoneRequestInterface::class         => UpdateShippingZoneRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Rates
        |--------------------------------------------------------------------------
        */
        StoreShippingRateRequestInterface::class          => StoreShippingRateRequest::class,
        UpdateShippingRateRequestInterface::class         => UpdateShippingRateRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */
        StoreProductRequestInterface::class          => StoreProductRequest::class,
        UpdateProductRequestInterface::class         => UpdateProductRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Attributes
        |--------------------------------------------------------------------------
        */
        StoreAttributeRequestInterface::class          => StoreAttributeRequest::class,
        UpdateAttributeRequestInterface::class         => UpdateAttributeRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Attribute Values
        |--------------------------------------------------------------------------
        */
        StoreAttributeValueRequestInterface::class          => StoreAttributeValueRequest::class,
        UpdateAttributeValueRequestInterface::class         => UpdateAttributeValueRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Inventories
        |--------------------------------------------------------------------------
        */
        StoreInventoryRequestInterface::class          => StoreInventoryRequest::class,
        UpdateInventoryRequestInterface::class         => UpdateInventoryRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        StoreUserRequestInterface::class => StoreUserRequest::class,
        UpdateUserRequestInterface::class => UpdateUserRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Providers
        |--------------------------------------------------------------------------
        */
        StorePaymentProviderRequestInterface::class => StorePaymentProviderRequest::class,
        UpdatePaymentProviderRequestInterface::class => UpdatePaymentProviderRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Options
        |--------------------------------------------------------------------------
        */
        StorePaymentOptionRequestInterface::class => StorePaymentOptionRequest::class,
        UpdatePaymentOptionRequestInterface::class => UpdatePaymentOptionRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Coupons
        |--------------------------------------------------------------------------
        */
        StoreCouponRequestInterface::class => StoreCouponRequest::class,
        UpdateCouponRequestInterface::class => UpdateCouponRequest::class,

        /*
        |--------------------------------------------------------------------------
        | Auto Discounts
        |--------------------------------------------------------------------------
        */
        StoreAutoDiscountRequestInterface::class => StoreAutoDiscountRequest::class,
        UpdateAutoDiscountRequestInterface::class => UpdateAutoDiscountRequest::class,

    ];
}
