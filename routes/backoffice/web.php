<?php

use App\Http\Controllers\Backoffice\AdminController;
use App\Http\Controllers\Backoffice\BannerController;
use App\Http\Controllers\Backoffice\CategoryController;
use App\Http\Controllers\Backoffice\CategoryGroupController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\MenuGroupController;
use App\Http\Controllers\Backoffice\MenuSubGroupController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admins
|--------------------------------------------------------------------------
*/

Route::get('/admins', [AdminController::class, 'index'])->name('admins.index')->middleware(['can:admins.index']);
Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create')->middleware(['can:admins.store']);
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store')->middleware(['can:admins.store']);
Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admins.show')->middleware(['can:admins.show']);
Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit')->middleware(['can:admins.update']);
Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update')->middleware(['can:admins.update']);
Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy')->middleware(['can:admins.delete']);

/*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
*/

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware(['can:roles.index']);
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware(['can:roles.store']);
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware(['can:roles.store']);
Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show')->middleware(['can:roles.show']);
Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['can:roles.update']);
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware(['can:roles.update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware(['can:roles.delete']);

/*
|--------------------------------------------------------------------------
| Category Groups
|--------------------------------------------------------------------------
*/

Route::get('/category-groups', [CategoryGroupController::class, 'index'])->name('category-groups.index')->middleware(['can:category-groups.index']);
Route::get('/category-groups/create', [CategoryGroupController::class, 'create'])->name('category-groups.create')->middleware(['can:category-groups.store']);
Route::post('/category-groups', [CategoryGroupController::class, 'store'])->name('category-groups.store')->middleware(['can:category-groups.store']);
Route::get('/category-groups/{id}', [CategoryGroupController::class, 'show'])->name('category-groups.show')->middleware(['can:category-groups.show']);
Route::get('/category-groups/{id}/edit', [CategoryGroupController::class, 'edit'])->name('category-groups.edit')->middleware(['can:category-groups.update']);
Route::put('/category-groups/{id}', [CategoryGroupController::class, 'update'])->name('category-groups.update')->middleware(['can:category-groups.update']);
Route::delete('/category-groups/{id}', [CategoryGroupController::class, 'destroy'])->name('category-groups.destroy')->middleware(['can:category-groups.delete']);

/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware(['can:categories.index']);
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware(['can:categories.store']);
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware(['can:categories.store']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show')->middleware(['can:categories.show']);
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware(['can:categories.update']);
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware(['can:categories.update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware(['can:categories.delete']);

/*
|--------------------------------------------------------------------------
| Products
|--------------------------------------------------------------------------
*/

// Uncomment nếu bạn muốn sử dụng và áp dụng middleware
// Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware(['can:products.index']);
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware(['can:products.store']);
// Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware(['can:products.store']);
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware(['can:products.show']);
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(['can:products.update']);
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware(['can:products.update']);
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(['can:products.delete']);

/*
|--------------------------------------------------------------------------
| Banners
|--------------------------------------------------------------------------
*/

Route::get('/banners', [BannerController::class, 'index'])->name('banners.index')->middleware(['can:banners.index']);
Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create')->middleware(['can:banners.store']);
Route::post('/banners', [BannerController::class, 'store'])->name('banners.store')->middleware(['can:banners.store']);
Route::get('/banners/{id}', [BannerController::class, 'show'])->name('banners.show')->middleware(['can:banners.show']);
Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit')->middleware(['can:banners.update']);
Route::put('/banners/{id}', [BannerController::class, 'update'])->name('banners.update')->middleware(['can:banners.update']);
Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy')->middleware(['can:banners.delete']);

/*
|--------------------------------------------------------------------------
| Menu Groups
|--------------------------------------------------------------------------
*/

Route::get('/menu-groups', [MenuGroupController::class, 'index'])->name('menu-groups.index')->middleware(['can:menu-groups.index']);
Route::get('/menu-groups/create', [MenuGroupController::class, 'create'])->name('menu-groups.create')->middleware(['can:menu-groups.store']);
Route::post('/menu-groups', [MenuGroupController::class, 'store'])->name('menu-groups.store')->middleware(['can:menu-groups.store']);
Route::get('/menu-groups/{id}', [MenuGroupController::class, 'show'])->name('menu-groups.show')->middleware(['can:menu-groups.show']);
Route::get('/menu-groups/{id}/edit', [MenuGroupController::class, 'edit'])->name('menu-groups.edit')->middleware(['can:menu-groups.update']);
Route::put('/menu-groups/{id}', [MenuGroupController::class, 'update'])->name('menu-groups.update')->middleware(['can:menu-groups.update']);
Route::delete('/menu-groups/{id}', [MenuGroupController::class, 'destroy'])->name('menu-groups.destroy')->middleware(['can:menu-groups.delete']);

/*
|--------------------------------------------------------------------------
| Menu Sub Groups
|--------------------------------------------------------------------------
*/

Route::get('/menu-sub-groups', [MenuSubGroupController::class, 'index'])->name('menu-sub-groups.index')->middleware(['can:menu-sub-groups.index']);
Route::get('/menu-sub-groups/create', [MenuSubGroupController::class, 'create'])->name('menu-sub-groups.create')->middleware(['can:menu-sub-groups.store']);
Route::post('/menu-sub-groups', [MenuSubGroupController::class, 'store'])->name('menu-sub-groups.store')->middleware(['can:menu-sub-groups.store']);
Route::get('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'show'])->name('menu-sub-groups.show')->middleware(['can:menu-sub-groups.show']);
Route::get('/menu-sub-groups/{id}/edit', [MenuSubGroupController::class, 'edit'])->name('menu-sub-groups.edit')->middleware(['can:menu-sub-groups.update']);
Route::put('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'update'])->name('menu-sub-groups.update')->middleware(['can:menu-sub-groups.update']);
Route::delete('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'destroy'])->name('menu-sub-groups.destroy')->middleware(['can:menu-sub-groups.delete']);
