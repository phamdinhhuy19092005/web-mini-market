<?php

namespace App\Providers\Backoffice;

use App\Repositories\AddressRepository;
use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\CategoryGroupRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\FaqTopicRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use App\Repositories\Interfaces\FaqRepositoryInterface;

// Repositories
use App\Repositories\AdminRepository;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Repositories\AutoDiscountRepository;
use App\Repositories\BannerRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryGroupRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FaqTopicRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\FaqRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Repositories\Interfaces\AttributeValueRepositoryInterface;
use App\Repositories\Interfaces\AutoDiscountRepositoryInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use App\Repositories\Interfaces\InventoryRepositoryInterface;
use App\Repositories\Interfaces\PaymentOptionRepositoryInterface;
use App\Repositories\Interfaces\PaymentProviderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ShippingRateRepositoryInterface;
use App\Repositories\Interfaces\ShippingZoneRepositoryInterface;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\WebsiteReviewRepositoryInterface;
use App\Repositories\InventoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\PaymentOptionRepository;
use App\Repositories\PaymentProviderRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ShippingRateRepository;
use App\Repositories\ShippingZoneRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubscriberRepository;
use App\Repositories\UserRepository;
use App\Repositories\WebsiteReviewRepository;

class BackofficeRepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [

        /*
        |--------------------------------------------------------------------------
        | Category Groups
        |--------------------------------------------------------------------------
        */
        CategoryGroupRepositoryInterface::class   => CategoryGroupRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        CategoryRepositoryInterface::class        => CategoryRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Sub Categories
        |--------------------------------------------------------------------------
        */
        SubCategoryRepositoryInterface::class        => SubCategoryRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Banners
        |--------------------------------------------------------------------------
        */
        BannerRepositoryInterface::class          => BannerRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */
        BrandRepositoryInterface::class          => BrandRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Admins
        |--------------------------------------------------------------------------
        */
        AdminRepositoryInterface::class           => AdminRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        RoleRepositoryInterface::class            => RoleRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Post Categories
        |--------------------------------------------------------------------------
        */
        PostCategoryRepositoryInterface::class    => PostCategoryRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Posts
        |--------------------------------------------------------------------------
        */
        PostRepositoryInterface::class            => PostRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */
        PageRepositoryInterface::class            => PageRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Faq Topics
        |--------------------------------------------------------------------------
        */
        FaqTopicRepositoryInterface::class        => FaqTopicRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Faqs
        |--------------------------------------------------------------------------
        */
        FaqRepositoryInterface::class        => FaqRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Countries
        |--------------------------------------------------------------------------
        */
        CountryRepositoryInterface::class        => CountryRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Currencies
        |--------------------------------------------------------------------------
        */
        CurrencyRepositoryInterface::class        => CurrencyRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Zones
        |--------------------------------------------------------------------------
        */
        ShippingZoneRepositoryInterface::class        => ShippingZoneRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Shipping Rates
        |--------------------------------------------------------------------------
        */
        ShippingRateRepositoryInterface::class        => ShippingRateRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Subscribers
        |--------------------------------------------------------------------------
        */
        SubscriberRepositoryInterface::class        => SubscriberRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */
        ProductRepositoryInterface::class        => ProductRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Attributes
        |--------------------------------------------------------------------------
        */
        AttributeRepositoryInterface::class        => AttributeRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Attribute Values
        |--------------------------------------------------------------------------
        */
        AttributeValueRepositoryInterface::class        => AttributeValueRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Inventories
        |--------------------------------------------------------------------------
        */
        InventoryRepositoryInterface::class        => InventoryRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        UserRepositoryInterface::class        => UserRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Providers
        |--------------------------------------------------------------------------
        */
        PaymentProviderRepositoryInterface::class        => PaymentProviderRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Payment Options
        |--------------------------------------------------------------------------
        */
        PaymentOptionRepositoryInterface::class        => PaymentOptionRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Coupons
        |--------------------------------------------------------------------------
        */
        CouponRepositoryInterface::class        => CouponRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Auto Discounts
        |--------------------------------------------------------------------------
        */
        AutoDiscountRepositoryInterface::class        => AutoDiscountRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Website Reviews
        |--------------------------------------------------------------------------
        */
        WebsiteReviewRepositoryInterface::class        => WebsiteReviewRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Addresses
        |--------------------------------------------------------------------------
        */
        AddressRepositoryInterface::class        => AddressRepository::class,

        /*
        |--------------------------------------------------------------------------
        | Carts
        |--------------------------------------------------------------------------
        */
        CartRepositoryInterface::class        => CartRepository::class,
    ];
}
