<?php

use App\Http\Controllers\Backoffice\Api\AdminController;
use App\Http\Controllers\Backoffice\Api\AttributeController;
use App\Http\Controllers\Backoffice\Api\AttributeValueController;
use App\Http\Controllers\Backoffice\Api\AutoDiscountController;
use App\Http\Controllers\Backoffice\Api\BannerController;
use App\Http\Controllers\Backoffice\Api\BrandController;
use App\Http\Controllers\Backoffice\Api\CategoryController;
use App\Http\Controllers\Backoffice\Api\CategoryGroupController;
use App\Http\Controllers\Backoffice\Api\CountryController;
use App\Http\Controllers\Backoffice\Api\CouponController;
use App\Http\Controllers\Backoffice\Api\CurrencyController;
use App\Http\Controllers\Backoffice\Api\FaqController;
use App\Http\Controllers\Backoffice\Api\FaqTopicController;
use App\Http\Controllers\Backoffice\Api\InventoryController;
use App\Http\Controllers\Backoffice\Api\PageController;
use App\Http\Controllers\Backoffice\Api\PaymentOptionController;
use App\Http\Controllers\Backoffice\Api\PaymentProviderController;
use App\Http\Controllers\Backoffice\Api\PostCategoryController;
use App\Http\Controllers\Backoffice\Api\PostController;
use App\Http\Controllers\Backoffice\Api\ProductController;
use App\Http\Controllers\Backoffice\Api\RoleController;
use App\Http\Controllers\Backoffice\Api\ShippingRateController;
use App\Http\Controllers\Backoffice\Api\ShippingZoneController;
use App\Http\Controllers\Backoffice\Api\SubCategoryController;
use App\Http\Controllers\Backoffice\Api\SubscriberController;
use App\Http\Controllers\Backoffice\Api\UserController;
use App\Http\Controllers\Backoffice\Api\WebsiteReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('bo/api')->name('bo.api.')->group(function () {

});

Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');


Route::get('/category-groups', [CategoryGroupController::class, 'index'])->name('category-groups.index');
Route::get('/category-groups/trash', [CategoryGroupController::class, 'trashList'])->name('category-groups.trash');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/trash', [CategoryController::class, 'trashList'])->name('categories.trash');

Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
Route::get('/sub-categories/trash', [SubCategoryController::class, 'trashList'])->name('sub-categories.trash');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/faq-topics', [FaqTopicController::class, 'index'])->name('faq-topics.index');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
Route::get('/shipping-zones', [ShippingZoneController::class, 'index'])->name('shipping-zones.index');
Route::get('/shipping-rates', [ShippingRateController::class, 'index'])->name('shipping-rates.index');
Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('/attribute-values', [AttributeValueController::class, 'index'])->name('attribute-values.index');
Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/payment-providers', [PaymentProviderController::class, 'index'])->name('payment-providers.index');
Route::get('/payment-options', [PaymentOptionController::class, 'index'])->name('payment-options.index');
Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('/auto-discounts', [AutoDiscountController::class, 'index'])->name('auto-discounts.index');
Route::get('/website-reviews', [WebsiteReviewController::class, 'index'])->name('website-reviews.index');