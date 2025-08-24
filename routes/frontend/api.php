<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\AddressController;
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
use App\Http\Controllers\Frontend\Api\AutoDiscountController;
use App\Http\Controllers\Frontend\Api\InventoryController;
use App\Http\Controllers\Frontend\Api\PaymentController;
use App\Http\Controllers\Frontend\Api\OrderController;
use App\Http\Controllers\Frontend\Api\CouponController;
use App\Http\Controllers\Frontend\Api\DistrictController;
use App\Http\Controllers\Frontend\Api\PageController;
use App\Http\Controllers\Frontend\Api\ProvinceController;
use App\Http\Controllers\Frontend\Api\WebsiteReviewController;
use App\Http\Controllers\Frontend\Api\ShippingZoneController;
use App\Http\Controllers\Frontend\Api\ShippingRateController;
use App\Http\Controllers\Frontend\Api\WardController;
use App\Http\Controllers\Frontend\Api\CartController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\Api\OrderAutoDiscountTestController;
use App\Http\Controllers\Frontend\Api\OrderDiscountTestController;
use App\Http\Controllers\Frontend\Api\SubscriberController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum', 'force.json')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/user/{userId}', [AddressController::class, 'getByUser'])->name('addresses.user');
    Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('addresses.show');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{ids}', [AddressController::class, 'update'])->name('addresses.update');
    Route::post('/addresses/{id}/default', [AddressController::class, 'setDefault']);

    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');

    // Thêm sản phẩm vào giỏ
    Route::post('/carts/items', [CartController::class, 'addItem'])->name('carts.add-item');
    Route::put('/carts/items/{item}', [CartController::class, 'updateItem'])->name('carts.update-item');
    Route::delete('/carts/items/{item}', [CartController::class, 'removeItem'])->name('carts.remove-item');
    Route::delete('/carts/clear', [CartController::class, 'clearCart'])->name('carts.clear');
    // Xóa merge giỏ hàng
    Route::post('/carts/sync-cart', [CartController::class, 'syncCart'])->name('carts.sync-cart');

    Route::post('/web-reviews/store', [WebsiteReviewController::class, 'store'])->name('web-reviews.store');

    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');

    // Route::get('/auto-discounts', [AutoDiscountController::class, 'index'])->name('auto-discounts.index');
    // Route::get('/auto-discounts/{id}', [AutoDiscountController::class, 'show'])->name('auto-discounts.show');

    // =========== ============
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Như này để lấy theo trạng thái
    //api/orders?order_status=PROCESSING => đang xử lý
    // Dô OrderStatusEnum để xem trạng thái

    //=========== =============

    // Cái này dùng tạo
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Này lấy order từ user nha dô OrderStatusEnum để xen trạng thái

    // Cái này là dùng để hủy đơn hàng
    Route::patch('/orders/{uuid}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Tạo session VNPAY (chưa tạo order, trả về URL cho FE)
    Route::post('/payment/create-session', [PaymentController::class, 'createSession'])->name('payment.create-session');

    // Callback từ VNPAY trả về → tạo order thật
    Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');


});
Route::get('/orders/{uuid}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


// ====================== Đánh giá website ======================
Route::get('/website-reviews', [WebsiteReviewController::class, 'index'])->name('website-reviews.index');

// ====================== Người dùng ======================
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// ====================== Sản phẩm ======================
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// ====================== Danh mục nhóm ======================
Route::get('/category-groups', [CategoryGroupController::class, 'index'])->name('category-groups.index');
Route::get('/category-groups/{slug}', [CategoryGroupController::class, 'show'])->name('category-groups.show');

// ====================== Danh mục chính ======================
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// ====================== Danh mục phụ ======================
Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
Route::get('/sub-categories/{slug}', [SubCategoryController::class, 'show'])->name('sub-categories.show');

// ====================== Banner ======================
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/banners/{id}', [BannerController::class, 'show'])->name('banners.show');

// ====================== Bài viết ======================
Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
Route::get('/post-categories/{slug}', [PostCategoryController::class, 'show'])->name('post-categories.show');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

// ====================== Trang tĩnh ======================
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
// Route::get('/pages/{id}', [PageController::class, 'show'])->name('pages.show');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// ====================== Câu hỏi thường gặp ======================
Route::get('/faq-topics', [FaqTopicController::class, 'index'])->name('faq-topics.index');
Route::get('/faq-topics/{id}', [FaqTopicController::class, 'show'])->name('faq-topics.show');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/faqs/{id}', [FaqController::class, 'show'])->name('faqs.show');

// ====================== Thương hiệu ======================
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{slug}', [BrandController::class, 'show'])->name('brands.show');

// ====================== Thuộc tính sản phẩm ======================
Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('/attributes/{id}', [AttributeController::class, 'show'])->name('attributes.show');

Route::get('/attribute-values', [AttributeValueController::class, 'index'])->name('attribute-values.index');
Route::get('/attribute-values/{id}', [AttributeValueController::class, 'show'])->name('attribute-values.show');

// ====================== Kho hàng ======================
Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventories/{slug}', [InventoryController::class, 'show'])->name('inventories.show');

// Route::get('/shipping-zones', [ShippingZoneController::class, 'index'])->name('shipping-zones.index');
// Route::get('/shipping-zones/{id}', [ShippingZoneController::class, 'show'])->name('shipping-zones.show');

// Route::get('/shipping-rates', [ShippingRateController::class, 'index'])->name('shipping-rates.index');
// Route::get('/shipping-rates/{id}', [ShippingRateController::class, 'show'])->name('shipping-rates.show');

// ====================== Đánh giá website ======================

Route::get('/web-reviews', [WebsiteReviewController::class, 'index'])->name('web-reviews.index');

// ====================== Địa chỉ ======================

Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
Route::get('/provinces/{id}', [ProvinceController::class, 'show'])->name('provinces.show');

Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('/districts/{id}', [DistrictController::class, 'show'])->name('districts.show');

Route::get('/wards/{districtCode}', [AddressController::class, 'getWardsByDistrict']);

Route::get('/wards', [WardController::class, 'index'])->name('wards.index');
Route::get('/wards/{id}', [WardController::class, 'show'])->name('wards.show');

Route::get('/districts/{provinceCode}', [AddressController::class, 'getDistrictsByProvince']);

//  ================== Đăng ký nhận bản tin ======================

Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscribers.store');

// ================== Tạo tài khoản và xác thực email ======================
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);





