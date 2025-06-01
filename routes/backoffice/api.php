<?php

use App\Http\Controllers\Backoffice\Api\AdminController;
use App\Http\Controllers\Backoffice\Api\BannerController;
use App\Http\Controllers\Backoffice\Api\CategoryController;
use App\Http\Controllers\Backoffice\Api\CategoryGroupController;
use App\Http\Controllers\Backoffice\Api\PageController;
use App\Http\Controllers\Backoffice\Api\PostCategoryController;
use App\Http\Controllers\Backoffice\Api\PostController;
use App\Http\Controllers\Backoffice\Api\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/category-groups', [CategoryGroupController::class, 'index'])->name('category-groups.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');

