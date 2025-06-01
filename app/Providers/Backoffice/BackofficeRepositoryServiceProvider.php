<?php

namespace App\Providers\Backoffice;

use App\Repositories as Repositories;
use App\Repositories\AdminRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoryGroupRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\CategoryGroupRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\RoleRepository;

class BackofficeRepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        Repositories\Interfaces\CategoryGroupRepositoryInterface::class => Repositories\CategoryGroupRepository::class,
        CategoryGroupRepositoryInterface::class => CategoryGroupRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        BannerRepositoryInterface::class => BannerRepository::class,
        AdminRepositoryInterface::class => AdminRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
        PostCategoryRepositoryInterface::class => PostCategoryRepository::class,
        PostRepositoryInterface::class => PostRepository::class,
        PageRepositoryInterface::class => PageRepository::class,
    ];

}
