<?php

namespace App\Providers\Backoffice;

use App\Contracts\Responses\Backoffice\ListAddressResponseContract;
use Illuminate\Support\ServiceProvider;

// Contracts
use App\Contracts\Responses\Backoffice\ListAdminResponseContract;
use App\Contracts\Responses\Backoffice\ListAttributeResponseContract;
use App\Contracts\Responses\Backoffice\ListAttributeValueResponseContract;
use App\Contracts\Responses\Backoffice\ListAutoDiscountResponseContract;
use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Contracts\Responses\Backoffice\ListBrandResponseContract;
use App\Contracts\Responses\Backoffice\ListCartResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\ListCategoryResponseContract;
use App\Contracts\Responses\Backoffice\ListCountryResponseContract;
use App\Contracts\Responses\Backoffice\ListCouponResponseContract;
use App\Contracts\Responses\Backoffice\ListCurrencyResponseContract;
use App\Contracts\Responses\Backoffice\ListFaqResponseContract;
use App\Contracts\Responses\Backoffice\ListFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\ListInventoryResponseContract;
use App\Contracts\Responses\Backoffice\ListOrderResponseContract;
use App\Contracts\Responses\Backoffice\ListPageResponseContract;
use App\Contracts\Responses\Backoffice\ListPaymentOptionResponseContract;
use App\Contracts\Responses\Backoffice\ListPaymentProviderResponseContract;
use App\Contracts\Responses\Backoffice\ListPostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\ListPostResponseContract;
use App\Contracts\Responses\Backoffice\ListProductResponseContract;
use App\Contracts\Responses\Backoffice\ListRoleResponseContract;
use App\Contracts\Responses\Backoffice\ListShippingOptionResponseContract;
use App\Contracts\Responses\Backoffice\ListShippingRateResponseContract;
use App\Contracts\Responses\Backoffice\ListShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\ListSubCategoryResponseContract;
use App\Contracts\Responses\Backoffice\ListSubscriberResponseContract;
use App\Contracts\Responses\Backoffice\ListUserResponseContract;
use App\Contracts\Responses\Backoffice\ListWebsiteReviewResponseContract;
use App\Contracts\Responses\Backoffice\StoreAddressResponseContract;
use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Contracts\Responses\Backoffice\StoreAttributeResponseContract;
use App\Contracts\Responses\Backoffice\StoreAttributeValueResponseContract;
use App\Contracts\Responses\Backoffice\StoreAutoDiscountResponseContract;
use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\StoreBrandResponseContract;
use App\Contracts\Responses\Backoffice\StoreCartResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\StoreCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreCouponResponseContract;
use App\Contracts\Responses\Backoffice\StoreFaqResponseContract;
use App\Contracts\Responses\Backoffice\StoreFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\StoreInventoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreOrderResponseContract;
use App\Contracts\Responses\Backoffice\StorePageResponseContract;
use App\Contracts\Responses\Backoffice\StorePaymentOptionResponseContract;
use App\Contracts\Responses\Backoffice\StorePaymentProviderResponseContract;
use App\Contracts\Responses\Backoffice\StorePostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StorePostResponseContract;
use App\Contracts\Responses\Backoffice\StoreProductResponseContract;
use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Contracts\Responses\Backoffice\StoreShippingOptionResponseContract;
use App\Contracts\Responses\Backoffice\StoreShippingRateResponseContract;
use App\Contracts\Responses\Backoffice\StoreShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\StoreSubCategoryResponseContract;
use App\Contracts\Responses\Backoffice\StoreUserResponseContract;
use App\Contracts\Responses\Backoffice\StoreWebsiteReviewResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAddressResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAttributeResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAttributeValueResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAutoDiscountResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBrandResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCartResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCouponResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\UpdateInventoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateOrderResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePageResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePaymentOptionResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePaymentProviderResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostResponseContract;
use App\Contracts\Responses\Backoffice\UpdateProductResponseContract;
use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingOptionResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingRateResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\UpdateSubCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateUserResponseContract;
use App\Contracts\Responses\Backoffice\UpdateWebsiteReviewResponseContract;
use App\Http\Responses\Backoffice\ListAddressResponse;
// Responses
use App\Http\Responses\Backoffice\ListAdminResponse;
use App\Http\Responses\Backoffice\ListAttributeResponse;
use App\Http\Responses\Backoffice\ListAttributeValueResponse;
use App\Http\Responses\Backoffice\ListAutoDiscountResponse;
use App\Http\Responses\Backoffice\ListBannerResponse;
use App\Http\Responses\Backoffice\ListBrandResponse;
use App\Http\Responses\Backoffice\ListCartResponse;
use App\Http\Responses\Backoffice\ListCategoryGroupResponse;
use App\Http\Responses\Backoffice\ListCategoryResponse;
use App\Http\Responses\Backoffice\ListCountryResponse;
use App\Http\Responses\Backoffice\ListCouponResponse;
use App\Http\Responses\Backoffice\ListCurrencyResponse;
use App\Http\Responses\Backoffice\ListFaqResponse;
use App\Http\Responses\Backoffice\ListFaqTopicResponse;
use App\Http\Responses\Backoffice\ListInventoryResponse;
use App\Http\Responses\Backoffice\ListOrderResponse;
use App\Http\Responses\Backoffice\ListPageResponse;
use App\Http\Responses\Backoffice\ListPaymentOptionResponse;
use App\Http\Responses\Backoffice\ListPaymentProviderResponse;
use App\Http\Responses\Backoffice\ListPostCategoryResponse;
use App\Http\Responses\Backoffice\ListPostResponse;
use App\Http\Responses\Backoffice\ListProductResponse;
use App\Http\Responses\Backoffice\ListRoleResponse;
use App\Http\Responses\Backoffice\ListShippingOptionResponse;
use App\Http\Responses\Backoffice\ListShippingRateResponse;
use App\Http\Responses\Backoffice\ListShippingZoneResponse;
use App\Http\Responses\Backoffice\ListSubCategoryResponse;
use App\Http\Responses\Backoffice\ListSubscriberResponse;
use App\Http\Responses\Backoffice\ListUserResponse;
use App\Http\Responses\Backoffice\ListWebsiteReviewResponse;
use App\Http\Responses\Backoffice\StoreAddressResponses;
use App\Http\Responses\Backoffice\StoreAdminResponses;
use App\Http\Responses\Backoffice\StoreAttributeResponses;
use App\Http\Responses\Backoffice\StoreAttributeValueResponses;
use App\Http\Responses\Backoffice\StoreAutoDiscountResponses;
use App\Http\Responses\Backoffice\StoreBannerResponses;
use App\Http\Responses\Backoffice\StoreBrandResponses;
use App\Http\Responses\Backoffice\StoreCartResponses;
use App\Http\Responses\Backoffice\StoreCategoryGroupResponses;
use App\Http\Responses\Backoffice\StoreCategoryResponses;
use App\Http\Responses\Backoffice\StoreCouponResponses;
use App\Http\Responses\Backoffice\StoreFaqResponses;
use App\Http\Responses\Backoffice\StoreFaqTopicResponses;
use App\Http\Responses\Backoffice\StoreInventoryResponses;
use App\Http\Responses\Backoffice\StoreOrderResponses;
use App\Http\Responses\Backoffice\StorePageResponses;
use App\Http\Responses\Backoffice\StorePaymentOptionResponses;
use App\Http\Responses\Backoffice\StorePaymentProviderResponses;
use App\Http\Responses\Backoffice\StorePostCategoryResponses;
use App\Http\Responses\Backoffice\StorePostResponses;
use App\Http\Responses\Backoffice\StoreProductResponses;
use App\Http\Responses\Backoffice\StoreRoleResponses;
use App\Http\Responses\Backoffice\StoreShippingOptionResponses;
use App\Http\Responses\Backoffice\StoreShippingRateResponses;
use App\Http\Responses\Backoffice\StoreShippingZoneResponses;
use App\Http\Responses\Backoffice\StoreSubCategoryResponses;
use App\Http\Responses\Backoffice\StoreUserResponses;
use App\Http\Responses\Backoffice\StoreWebsiteReviewResponses;
use App\Http\Responses\Backoffice\UpdateAddressResponses;
use App\Http\Responses\Backoffice\UpdateAdminResponses;
use App\Http\Responses\Backoffice\UpdateAttributeResponses;
use App\Http\Responses\Backoffice\UpdateAttributeValueResponses;
use App\Http\Responses\Backoffice\UpdateAutoDiscountResponses;
use App\Http\Responses\Backoffice\UpdateBannerResponses;
use App\Http\Responses\Backoffice\UpdateBrandResponses;
use App\Http\Responses\Backoffice\UpdateCartResponses;
use App\Http\Responses\Backoffice\UpdateCategoryGroupResponses;
use App\Http\Responses\Backoffice\UpdateCategoryResponses;
use App\Http\Responses\Backoffice\UpdateCouponResponses;
use App\Http\Responses\Backoffice\UpdateFaqResponses;
use App\Http\Responses\Backoffice\UpdateFaqTopicResponses;
use App\Http\Responses\Backoffice\UpdateInventoryResponses;
use App\Http\Responses\Backoffice\UpdateOrderResponses;
use App\Http\Responses\Backoffice\UpdatePageResponses;
use App\Http\Responses\Backoffice\UpdatePaymentOptionResponses;
use App\Http\Responses\Backoffice\UpdatePaymentProviderResponses;
use App\Http\Responses\Backoffice\UpdatePostCategoryResponses;
use App\Http\Responses\Backoffice\UpdatePostResponses;
use App\Http\Responses\Backoffice\UpdateProductResponses;
use App\Http\Responses\Backoffice\UpdateRoleResponses;
use App\Http\Responses\Backoffice\UpdateShippingOptionResponses;
use App\Http\Responses\Backoffice\UpdateShippingRateResponses;
use App\Http\Responses\Backoffice\UpdateShippingZoneResponses;
use App\Http\Responses\Backoffice\UpdateSubCategoryResponses;
use App\Http\Responses\Backoffice\UpdateUserResponses;
use App\Http\Responses\Backoffice\UpdateWebsiteReviewResponses;

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
        | Brands
        |--------------------------------------------------------------------------
        */
        StoreBrandResponseContract::class           => StoreBrandResponses::class,
        UpdateBrandResponseContract::class          => UpdateBrandResponses::class,
        ListBrandResponseContract::class            => ListBrandResponse::class,

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
        | Sub Categories
        |--------------------------------------------------------------------------
        */
        StoreSubCategoryResponseContract::class         => StoreSubCategoryResponses::class,
        UpdateSubCategoryResponseContract::class        => UpdateSubCategoryResponses::class,
        ListSubCategoryResponseContract::class          => ListSubCategoryResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        StoreRoleResponseContract::class             => StoreRoleResponses::class,
        UpdateRoleResponseContract::class            => UpdateRoleResponses::class,
        ListRoleResponseContract::class              => ListRoleResponse::class,

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
        | Currencies
        |--------------------------------------------------------------------------
        */
        ListSubscriberResponseContract::class         => ListSubscriberResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Zones
        |--------------------------------------------------------------------------
        */
        StoreShippingZoneResponseContract::class         => StoreShippingZoneResponses::class,
        UpdateShippingZoneResponseContract::class        => UpdateShippingZoneResponses::class,
        ListShippingZoneResponseContract::class          => ListShippingZoneResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Rates
        |--------------------------------------------------------------------------
        */
        StoreShippingRateResponseContract::class         => StoreShippingRateResponses::class,
        UpdateShippingRateResponseContract::class        => UpdateShippingRateResponses::class,
        ListShippingRateResponseContract::class          => ListShippingRateResponse::class,
        
        /*
        |--------------------------------------------------------------------------
        | Shipping Options
        |--------------------------------------------------------------------------
        */
        StoreShippingOptionResponseContract::class         => StoreShippingOptionResponses::class,
        UpdateShippingOptionResponseContract::class        => UpdateShippingOptionResponses::class,
        ListShippingOptionResponseContract::class          => ListShippingOptionResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */
        StoreProductResponseContract::class         => StoreProductResponses::class,
        UpdateProductResponseContract::class        => UpdateProductResponses::class,
        ListProductResponseContract::class          => ListProductResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Arrtibutes
        |--------------------------------------------------------------------------
        */
        StoreAttributeResponseContract::class         => StoreAttributeResponses::class,
        UpdateAttributeResponseContract::class        => UpdateAttributeResponses::class,
        ListAttributeResponseContract::class          => ListAttributeResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Arrtibute Values
        |--------------------------------------------------------------------------
        */
        StoreAttributeValueResponseContract::class         => StoreAttributeValueResponses::class,
        UpdateAttributeValueResponseContract::class        => UpdateAttributeValueResponses::class,
        ListAttributeValueResponseContract::class          => ListAttributeValueResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Inventories
        |--------------------------------------------------------------------------
        */
        StoreInventoryResponseContract::class         => StoreInventoryResponses::class,
        UpdateInventoryResponseContract::class        => UpdateInventoryResponses::class,
        ListInventoryResponseContract::class          => ListInventoryResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        StoreUserResponseContract::class         => StoreUserResponses::class,
        UpdateUserResponseContract::class        => UpdateUserResponses::class,
        ListUserResponseContract::class          => ListUserResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Providers
        |--------------------------------------------------------------------------
        */
        StorePaymentProviderResponseContract::class         => StorePaymentProviderResponses::class,
        UpdatePaymentProviderResponseContract::class        => UpdatePaymentProviderResponses::class,
        ListPaymentProviderResponseContract::class          => ListPaymentProviderResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Options
        |--------------------------------------------------------------------------
        */
        StorePaymentOptionResponseContract::class         => StorePaymentOptionResponses::class,
        UpdatePaymentOptionResponseContract::class        => UpdatePaymentOptionResponses::class,
        ListPaymentOptionResponseContract::class          => ListPaymentOptionResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Coupons
        |--------------------------------------------------------------------------
        */
        StoreCouponResponseContract::class         => StoreCouponResponses::class,
        UpdateCouponResponseContract::class        => UpdateCouponResponses::class,
        ListCouponResponseContract::class          => ListCouponResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Auto Discounts
        |--------------------------------------------------------------------------
        */
        StoreAutoDiscountResponseContract::class         => StoreAutoDiscountResponses::class,
        UpdateAutoDiscountResponseContract::class        => UpdateAutoDiscountResponses::class,
        ListAutoDiscountResponseContract::class          => ListAutoDiscountResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Website Reviews
        |--------------------------------------------------------------------------
        */
        StoreWebsiteReviewResponseContract::class         => StoreWebsiteReviewResponses::class,
        UpdateWebsiteReviewResponseContract::class        => UpdateWebsiteReviewResponses::class,
        ListWebsiteReviewResponseContract::class          => ListWebsiteReviewResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Addresses
        |--------------------------------------------------------------------------
        */
        StoreAddressResponseContract::class         => StoreAddressResponses::class,
        UpdateAddressResponseContract::class        => UpdateAddressResponses::class,
        ListAddressResponseContract::class          => ListAddressResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Carts
        |--------------------------------------------------------------------------
        */
        StoreCartResponseContract::class         => StoreCartResponses::class,
        UpdateCartResponseContract::class        => UpdateCartResponses::class,
        ListCartResponseContract::class          => ListCartResponse::class,

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */
        StoreOrderResponseContract::class         => StoreOrderResponses::class,
        UpdateOrderResponseContract::class        => UpdateOrderResponses::class,
        ListOrderResponseContract::class          => ListOrderResponse::class,
    ];
}
