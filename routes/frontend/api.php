<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\UserController;
use App\Http\Controllers\Frontend\Api\ProductController;
use App\Http\Controllers\Frontend\Api\CategoryGroupController;
use App\Http\Controllers\Frontend\Api\CategoryController;
use App\Http\Controllers\Frontend\Api\SubCategoryController;
use App\Http\Controllers\Frontend\Api\BannerController;
use App\Http\Controllers\Frontend\Api\PostCategoryController;
use App\Http\Controllers\Frontend\Api\PostController;
use App\Http\Controllers\Frontend\Api\FaqTopicController;
use App\Http\Controllers\Frontend\Api\FaqController;
use App\Http\Controllers\Frontend\Api\BrandController;
use App\Http\Controllers\Frontend\Api\AttributeController;
use App\Http\Controllers\Frontend\Api\AttributeValueController;
use App\Http\Controllers\Frontend\Api\InventoryController;
use App\Http\Controllers\Frontend\Api\PaymentController;
use App\Http\Controllers\Frontend\Api\OrderController;
use App\Http\Controllers\Frontend\Api\CouponController;
use App\Http\Controllers\Frontend\Api\WebsiteReviewController;
use App\Http\Controllers\Frontend\Api\ShippingZoneController;
use App\Http\Controllers\Frontend\Api\ShippingRateController;


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    // Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');

    Route::get('/website-reviews', [WebsiteReviewController::class, 'index'])->name('website-reviews.index');
    Route::post('/website-reviews', [WebsiteReviewController::class, 'store'])->name('website-reviews.store');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/category-groups', [CategoryGroupController::class, 'index'])->name('category-groups.index');
Route::get('/category-groups/{id}', [CategoryGroupController::class, 'show'])->name('category-groups.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
Route::get('/sub-categories/{id}', [SubCategoryController::class, 'show'])->name('sub-categories.show');

Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/banners/{id}', [BannerController::class, 'show'])->name('banners.show');

Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
Route::get('/post-categories/{id}', [PostCategoryController::class, 'show'])->name('post-categories.show');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/faq-topics', [FaqTopicController::class, 'index'])->name('faq-topics.index');
Route::get('/faq-topics/{id}', [FaqTopicController::class, 'show'])->name('faq-topics.show');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/faqs/{id}', [FaqController::class, 'show'])->name('faqs.show');

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brands.show');

Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('/attributes/{id}', [AttributeController::class, 'show'])->name('attributes.show');

Route::get('/attribute-values', [AttributeValueController::class, 'index'])->name('attribute-values.index');
Route::get('/attribute-values/{id}', [AttributeValueController::class, 'show'])->name('attribute-values.show');

Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventories/{id}', [InventoryController::class, 'show'])->name('inventories.show');

// Route::get('/shipping-zones', [ShippingZoneController::class, 'index'])->name('shipping-zones.index');
// Route::get('/shipping-zones/{id}', [ShippingZoneController::class, 'show'])->name('shipping-zones.show');

// Route::get('/shipping-rates', [ShippingRateController::class, 'index'])->name('shipping-rates.index');
// Route::get('/shipping-rates/{id}', [ShippingRateController::class, 'show'])->name('shipping-rates.show');

Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');