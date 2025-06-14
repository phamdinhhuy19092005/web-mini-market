<?php

namespace App\Providers\Backoffice;

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
use App\Repositories\BannerRepository;
use App\Repositories\CategoryGroupRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FaqTopicRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\FaqRepository;
use App\Repositories\Interfaces\ShippingZoneRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ShippingZoneRepository;

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
        | Banners
        |--------------------------------------------------------------------------
        */
        BannerRepositoryInterface::class          => BannerRepository::class,

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
    ];
}
