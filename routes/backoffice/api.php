<?php

use App\Http\Controllers\Backoffice\Api\AddressController;
use App\Http\Controllers\Backoffice\Api\AdminController;
use App\Http\Controllers\Backoffice\Api\AttributeController;
use App\Http\Controllers\Backoffice\Api\AttributeValueController;
use App\Http\Controllers\Backoffice\Api\AutoDiscountController;
use App\Http\Controllers\Backoffice\Api\BannerController;
use App\Http\Controllers\Backoffice\Api\BrandController;
use App\Http\Controllers\Backoffice\Api\CartController;
use App\Http\Controllers\Backoffice\Api\CategoryController;
use App\Http\Controllers\Backoffice\Api\CategoryGroupController;
use App\Http\Controllers\Backoffice\Api\CountryController;
use App\Http\Controllers\Backoffice\Api\CouponController;
use App\Http\Controllers\Backoffice\Api\CurrencyController;
use App\Http\Controllers\Backoffice\Api\FaqController;
use App\Http\Controllers\Backoffice\Api\FaqTopicController;
use App\Http\Controllers\Backoffice\Api\InventoryController;
use App\Http\Controllers\Backoffice\Api\OrderController;
use App\Http\Controllers\Backoffice\Api\OrderItemController;
use App\Http\Controllers\Backoffice\Api\PageController;
use App\Http\Controllers\Backoffice\Api\PaymentOptionController;
use App\Http\Controllers\Backoffice\Api\PaymentProviderController;
use App\Http\Controllers\Backoffice\Api\PostCategoryController;
use App\Http\Controllers\Backoffice\Api\PostController;
use App\Http\Controllers\Backoffice\Api\ProductController;
use App\Http\Controllers\Backoffice\Api\RoleController;
use App\Http\Controllers\Backoffice\Api\ShippingOptionController;
use App\Http\Controllers\Backoffice\Api\ShippingRateController;
use App\Http\Controllers\Backoffice\Api\ShippingZoneController;
use App\Http\Controllers\Backoffice\Api\SubCategoryController;
use App\Http\Controllers\Backoffice\Api\SubscriberController;
use App\Http\Controllers\Backoffice\Api\UserController;
use App\Http\Controllers\Backoffice\Api\WebsiteReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
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
    Route::get('/shipping-options', [ShippingOptionController::class, 'index'])->name('shipping-options.index');
    Route::get('/shipping-options/available', [ShippingOptionController::class, 'getAvailableShippingOptions'])->name('shipping-options.available');
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
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');

    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::get('/carts/{userId}', [CartController::class, 'userCarts'])->name('carts.user');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/{userId}', [OrderController::class, 'userOrders'])->name('orders.user');

    Route::post('/orders/{id}/deposit', [OrderController::class, 'createDeposit'])->name('orders.createDeposit');

    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/order-status/{orderStatus}', [OrderController::class, 'statisticOrderStatus'])->name('orders.statistic.order-status');
    Route::get('/orders/{order}/items', [OrderController::class, 'items'])->name('orders.items');

    Route::put('orders/{id}/delivery', [OrderController::class, 'delivery'])->name('orders.delivery');
    Route::put('orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::put('orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('orders/{id}/refund', [OrderController::class, 'refund'])->name('orders.refund');
    Route::post('/orders/{id}/processing', [OrderController::class, 'updateToProcessing'])->name('orders.processing');

    Route::post('/orders/{id}/apply-coupon', [OrderController::class, 'applyCoupon'])->name('orders.apply-coupon');

    Route::get('bo/api/orders/statistics', [OrderController::class, 'statistics'])->name('orders.statistics');


    Route::put('orders/{id}/update-shipping', [OrderController::class, 'updateShipping'])->name('orders.update-shipping');
    
    Route::get('/order-items', [OrderItemController::class, 'index'])->name('order-items.index');
});
