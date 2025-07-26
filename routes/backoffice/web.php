<?php

use App\Http\Controllers\Backoffice\AdminController;
use App\Http\Controllers\Backoffice\AttributeController;
use App\Http\Controllers\Backoffice\AttributeValueController;
use App\Http\Controllers\Backoffice\AutoDiscountController;
use App\Http\Controllers\Backoffice\BannerController;
use App\Http\Controllers\Backoffice\BrandController;
use App\Http\Controllers\Backoffice\CategoryController;
use App\Http\Controllers\Backoffice\CategoryGroupController;
use App\Http\Controllers\Backoffice\CountryController;
use App\Http\Controllers\Backoffice\CouponController;
use App\Http\Controllers\Backoffice\CurrencyController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\DepositTransactionController;
use App\Http\Controllers\Backoffice\EmailController;
use App\Http\Controllers\Backoffice\FaqController;
use App\Http\Controllers\Backoffice\FaqTopicController;
use App\Http\Controllers\Backoffice\FileManagerController;
use App\Http\Controllers\Backoffice\InventoryController;
use App\Http\Controllers\Backoffice\MenuGroupController;
use App\Http\Controllers\Backoffice\OrderController;
// use App\Http\Controllers\Backoffice\MenuSubGroupController;
use App\Http\Controllers\Backoffice\PageController;
use App\Http\Controllers\Backoffice\PaymentController;
use App\Http\Controllers\Backoffice\PaymentOptionController;
use App\Http\Controllers\Backoffice\PaymentProviderController;
use App\Http\Controllers\Backoffice\PostCategoryController;
use App\Http\Controllers\Backoffice\PostController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\ShippingRateController;
use App\Http\Controllers\Backoffice\ShippingZoneController;
use App\Http\Controllers\Backoffice\SubCategoryController;
use App\Http\Controllers\Backoffice\SubscriberController;
use App\Http\Controllers\Backoffice\SystemSettingController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Backoffice\WebsiteReviewController;
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
Route::post('/admins/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

Route::put('/admins/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('auth:admin');
Route::put('/admins/password', [AdminController::class, 'updatePassword'])->name('admin.password.update')->middleware('auth:admin');

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

Route::get('/category-groups/trash', [CategoryGroupController::class, 'trash'])->name('category-groups.trash');
Route::post('/category-groups/{id}/restore', [CategoryGroupController::class, 'restore'])->name('category-groups.restore');

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

Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

/*
|--------------------------------------------------------------------------
| Sub Categories
|--------------------------------------------------------------------------
*/

Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index')->middleware(['can:categories.index']);
Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create')->middleware(['can:categories.store']);
Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store')->middleware(['can:categories.store']);
Route::get('/sub-categories/{id}', [SubCategoryController::class, 'show'])->name('sub-categories.show')->middleware(['can:categories.show']);
Route::get('/sub-categories/{id}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit')->middleware(['can:categories.update']);
Route::put('/sub-categories/{id}', [SubCategoryController::class, 'update'])->name('sub-categories.update')->middleware(['can:categories.update']);
Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy')->middleware(['can:categories.delete']);

Route::get('/sub-categories/trash', [SubCategoryController::class, 'trash'])->name('sub-categories.trash');
Route::post('/sub-categories/{id}/restore', [SubCategoryController::class, 'restore'])->name('sub-categories.restore');

/*
|--------------------------------------------------------------------------
| Products
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

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

// Route::get('/menu-sub-groups', [MenuSubGroupController::class, 'index'])->name('menu-sub-groups.index')->middleware(['can:menu-sub-groups.index']);
// Route::get('/menu-sub-groups/create', [MenuSubGroupController::class, 'create'])->name('menu-sub-groups.create')->middleware(['can:menu-sub-groups.store']);
// Route::post('/menu-sub-groups', [MenuSubGroupController::class, 'store'])->name('menu-sub-groups.store')->middleware(['can:menu-sub-groups.store']);
// Route::get('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'show'])->name('menu-sub-groups.show')->middleware(['can:menu-sub-groups.show']);
// Route::get('/menu-sub-groups/{id}/edit', [MenuSubGroupController::class, 'edit'])->name('menu-sub-groups.edit')->middleware(['can:menu-sub-groups.update']);
// Route::put('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'update'])->name('menu-sub-groups.update')->middleware(['can:menu-sub-groups.update']);
// Route::delete('/menu-sub-groups/{id}', [MenuSubGroupController::class, 'destroy'])->name('menu-sub-groups.destroy')->middleware(['can:menu-sub-groups.delete']);

/*
|--------------------------------------------------------------------------
| Post Categories
|--------------------------------------------------------------------------
*/

Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
Route::get('/post-categories/create', [PostCategoryController::class, 'create'])->name('post-categories.create');
Route::post('/post-categories', [PostCategoryController::class, 'store'])->name('post-categories.store');
Route::get('/post-categories/{id}', [PostCategoryController::class, 'show'])->name('post-categories.show');
Route::get('/post-categories/{id}/edit', [PostCategoryController::class, 'edit'])->name('post-categories.edit');
Route::put('/post-categories/{id}', [PostCategoryController::class, 'update'])->name('post-categories.update');
Route::delete('/post-categories/{id}', [PostCategoryController::class, 'destroy'])->name('post-categories.destroy');

/*
|--------------------------------------------------------------------------
| Posts
|--------------------------------------------------------------------------
*/

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{id}', [PageController::class, 'show'])->name('pages.show');
Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');

/*
|--------------------------------------------------------------------------
| Faq-topics
|--------------------------------------------------------------------------
*/

Route::get('/faq-topics', [FaqTopicController::class, 'index'])->name('faq-topics.index');
Route::get('/faq-topics/create', [FaqTopicController::class, 'create'])->name('faq-topics.create');
Route::post('/faq-topics', [FaqTopicController::class, 'store'])->name('faq-topics.store');
Route::get('/faq-topics/{id}', [FaqTopicController::class, 'show'])->name('faq-topics.show');
Route::get('/faq-topics/{id}/edit', [FaqTopicController::class, 'edit'])->name('faq-topics.edit');
Route::put('/faq-topics/{id}', [FaqTopicController::class, 'update'])->name('faq-topics.update');
Route::delete('/faq-topics/{id}', [FaqTopicController::class, 'destroy'])->name('faq-topics.destroy');

/*
|--------------------------------------------------------------------------
| Faqs
|--------------------------------------------------------------------------
*/

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
Route::get('/faqs/{id}', [FaqController::class, 'show'])->name('faqs.show');
Route::get('/faqs/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
Route::put('/faqs/{id}', [FaqController::class, 'update'])->name('faqs.update');
Route::delete('/faqs/{id}', [FaqController::class, 'destroy'])->name('faqs.destroy');

/*
|--------------------------------------------------------------------------
| Nations
|--------------------------------------------------------------------------
*/

Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.index');

/*
|--------------------------------------------------------------------------
| System Setting
|--------------------------------------------------------------------------
*/

Route::get('system-settings', [SystemSettingController::class, 'index'])->name('system-settings.index');
Route::get('system-settings/{id}/edit', [SystemSettingController::class, 'edit'])->name('system-settings.edit');
Route::post('system-settings/{id}/update', [SystemSettingController::class, 'update'])->name('system-settings.update');

/*
|--------------------------------------------------------------------------
| Shipping Zones
|--------------------------------------------------------------------------
*/

Route::get('/shipping-zones', [ShippingZoneController::class, 'index'])->name('shipping-zones.index');
Route::get('/shipping-zones/create', [ShippingZoneController::class, 'create'])->name('shipping-zones.create');
Route::post('/shipping-zones', [ShippingZoneController::class, 'store'])->name('shipping-zones.store');
Route::get('/shipping-zones/{id}', [ShippingZoneController::class, 'show'])->name('shipping-zones.show');
Route::get('/shipping-zones/{id}/edit', [ShippingZoneController::class, 'edit'])->name('shipping-zones.edit');
Route::put('/shipping-zones/{id}', [ShippingZoneController::class, 'update'])->name('shipping-zones.update');
Route::delete('/shipping-zones/{id}', [ShippingZoneController::class, 'destroy'])->name('shipping-zones.destroy');

/*
|--------------------------------------------------------------------------
| Shipping Rates
|--------------------------------------------------------------------------
*/

Route::get('/shipping-rates', [ShippingRateController::class, 'index'])->name('shipping-rates.index');
Route::get('/shipping-rates/create', [ShippingRateController::class, 'create'])->name('shipping-rates.create');
Route::post('/shipping-rates', [ShippingRateController::class, 'store'])->name('shipping-rates.store');
Route::get('/shipping-rates/{id}', [ShippingRateController::class, 'show'])->name('shipping-rates.show');
Route::get('/shipping-rates/{id}/edit', [ShippingRateController::class, 'edit'])->name('shipping-rates.edit');
Route::put('/shipping-rates/{id}', [ShippingRateController::class, 'update'])->name('shipping-rates.update');
Route::delete('/shipping-rates/{id}', [ShippingRateController::class, 'destroy'])->name('shipping-rates.destroy');


/*
|--------------------------------------------------------------------------
| Subscribers
|--------------------------------------------------------------------------
*/
Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');

/*
|--------------------------------------------------------------------------
| Brands
|--------------------------------------------------------------------------
*/

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

/*
|--------------------------------------------------------------------------
| Attributes
|--------------------------------------------------------------------------
*/

Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('/attributes/create', [AttributeController::class, 'create'])->name('attributes.create');
Route::post('attributes', [AttributeController::class, 'store'])->name('attributes.store');
Route::get('/attributes/{id}', [AttributeController::class, 'show'])->name('attributes.show');
Route::get('/attributes/{id}/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
Route::put('/attributes/{id}', [AttributeController::class, 'update'])->name('attributes.update');
Route::delete('/attributes/{id}', [AttributeController::class, 'destroy'])->name('attributes.destroy');

/*
|--------------------------------------------------------------------------
| Attribute Values
|--------------------------------------------------------------------------
*/

Route::get('/attribute-values', [AttributeValueController::class, 'index'])->name('attribute-values.index');
Route::get('/attribute-values/create', [AttributeValueController::class, 'create'])->name('attribute-values.create');
Route::post('attribute-values', [AttributeValueController::class, 'store'])->name('attribute-values.store');
Route::get('/attribute-values/{id}', [AttributeValueController::class, 'show'])->name('attribute-values.show');
Route::get('/attribute-values/{id}/edit', [AttributeValueController::class, 'edit'])->name('attribute-values.edit');
Route::put('/attribute-values/{id}', [AttributeValueController::class, 'update'])->name('attribute-values.update');
Route::delete('/attribute-values/{id}', [AttributeValueController::class, 'destroy'])->name('attribute-values.destroy');

/*
|--------------------------------------------------------------------------
| Inventories
|--------------------------------------------------------------------------
*/

Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
Route::post('inventories', [InventoryController::class, 'store'])->name('inventories.store');
Route::get('/inventories/{id}', [InventoryController::class, 'edit'])->name('inventories.edit');
Route::put('/inventories/{id}', [InventoryController::class, 'update'])->name('inventories.update');
Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.action.deactivate');
Route::post('active/{id}/active', [UserController::class, 'active'])->name('users.action.active');

/*
|--------------------------------------------------------------------------
| Payment Providers
|--------------------------------------------------------------------------
*/

Route::get('/payment-providers', [PaymentProviderController::class, 'index'])->name('payment-providers.index');
Route::get('/payment-providers/create', [PaymentProviderController::class, 'create'])->name('payment-providers.create');
Route::post('payment-providers', [PaymentProviderController::class, 'store'])->name('payment-providers.store');
Route::get('/payment-providers/{id}/edit', [PaymentProviderController::class, 'edit'])->name('payment-providers.edit');
Route::get('/payment-providers/{id}', [PaymentProviderController::class, 'show'])->name('payment-providers.show');
Route::put('/payment-providers/{id}', [PaymentProviderController::class, 'update'])->name('payment-providers.update');
Route::delete('/payment-providers/{id}', [PaymentProviderController::class, 'destroy'])->name('payment-providers.destroy');


/*
|--------------------------------------------------------------------------
| Payment Options
|--------------------------------------------------------------------------
*/

Route::get('/payment-options', [PaymentOptionController::class, 'index'])->name('payment-options.index');
Route::get('/payment-options/create', [PaymentOptionController::class, 'create'])->name('payment-options.create');
Route::post('payment-options', [PaymentOptionController::class, 'store'])->name('payment-options.store');
Route::get('/payment-options/{id}/edit', [PaymentOptionController::class, 'edit'])->name('payment-options.edit');
Route::get('/payment-options/{id}', [PaymentOptionController::class, 'show'])->name('payment-options.show');
Route::put('/payment-options/{id}', [PaymentOptionController::class, 'update'])->name('payment-options.update');
Route::delete('/payment-options/{id}', [PaymentOptionController::class, 'destroy'])->name('payment-options.destroy');


/*
|--------------------------------------------------------------------------
| Coupons
|--------------------------------------------------------------------------
*/

Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
Route::post('coupons', [CouponController::class, 'store'])->name('coupons.store');
Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');
Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('coupons.update');
Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');


/*
|--------------------------------------------------------------------------
| Discount Rules
|--------------------------------------------------------------------------
*/

Route::get('/auto-discounts', [AutoDiscountController::class, 'index'])->name('auto-discounts.index');
Route::get('/auto-discounts/create', [AutoDiscountController::class, 'create'])->name('auto-discounts.create');
Route::post('auto-discounts', [AutoDiscountController::class, 'store'])->name('auto-discounts.store');
Route::get('/auto-discounts/{id}/edit', [AutoDiscountController::class, 'edit'])->name('auto-discounts.edit');
Route::get('/auto-discounts/{id}', [AutoDiscountController::class, 'show'])->name('auto-discounts.show');
Route::put('/auto-discounts/{id}', [AutoDiscountController::class, 'update'])->name('auto-discounts.update');
Route::delete('/auto-discounts/{id}', [AutoDiscountController::class, 'destroy'])->name('auto-discounts.destroy');

/*
|--------------------------------------------------------------------------
| Discount Rules
|--------------------------------------------------------------------------
*/

Route::get('/auto-discounts', [AutoDiscountController::class, 'index'])->name('auto-discounts.index');
Route::get('/auto-discounts/create', [AutoDiscountController::class, 'create'])->name('auto-discounts.create');
Route::post('auto-discounts', [AutoDiscountController::class, 'store'])->name('auto-discounts.store');
Route::get('/auto-discounts/{id}/edit', [AutoDiscountController::class, 'edit'])->name('auto-discounts.edit');
Route::get('/auto-discounts/{id}', [AutoDiscountController::class, 'show'])->name('auto-discounts.show');
Route::put('/auto-discounts/{id}', [AutoDiscountController::class, 'update'])->name('auto-discounts.update');
Route::delete('/auto-discounts/{id}', [AutoDiscountController::class, 'destroy'])->name('auto-discounts.destroy');

/*
|--------------------------------------------------------------------------
| Website Reviews
|--------------------------------------------------------------------------
*/

Route::get('/website-reviews', [WebsiteReviewController::class, 'index'])->name('website-reviews.index');
Route::get('/website-reviews/create', [WebsiteReviewController::class, 'create'])->name('website-reviews.create');
Route::post('website-reviews', [WebsiteReviewController::class, 'store'])->name('website-reviews.store');
Route::get('/website-reviews/{id}/edit', [WebsiteReviewController::class, 'edit'])->name('website-reviews.edit');
Route::get('/website-reviews/{id}', [WebsiteReviewController::class, 'show'])->name('website-reviews.show');
Route::put('/website-reviews/{id}', [WebsiteReviewController::class, 'update'])->name('website-reviews.update');
Route::delete('/website-reviews/{id}', [WebsiteReviewController::class, 'destroy'])->name('website-reviews.destroy');


/*
|--------------------------------------------------------------------------
| Orders
|--------------------------------------------------------------------------
*/

Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');

/*
|--------------------------------------------------------------------------
| Test
|--------------------------------------------------------------------------
*/

Route::post('/file-manager/upload', [FileManagerController::class, 'upload'])->name('file-manager.upload');

Route::get('/admin/emails/send', [EmailController::class, 'showForm'])->name('admin.emails.form');
Route::post('/admin/emails/send', [EmailController::class, 'send'])->name('admin.emails.send');

Route::post('/subscribers/send-mail', [SubscriberController::class, 'sendMail'])->name('subscribers.sendmail');


Route::get('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');
Route::post('/payment/ipn', [PaymentController::class, 'paymentIpn'])->name('payment.ipn')->withoutMiddleware(['web', 'auth:admin']);

Route::resource('deposit-transactions', DepositTransactionController::class)->names('deposit-transactions');

Route::get('order', [OrderController::class, 'create']);

Route::get('/test-signature', function () {
    $vnp_HashSecret = config('services.vnpay.hash_secret');
    $input = [
        "vnp_Amount" => "1000000",
        "vnp_BankCode" => "NCB",
        "vnp_OrderInfo" => "Thanh toan don hang test",
        "vnp_TxnRef" => "123456789",
        "vnp_ResponseCode" => "00",
        "vnp_PayDate" => "20250725082200"
    ];

    ksort($input);
    $query = "";
    foreach ($input as $key => $value) {
        $query .= $key . "=" . $value . "&";
    }
    $query = rtrim($query, "&");
    $secureHash = hash_hmac('sha512', $query, $vnp_HashSecret);

    return response()->json([
        'data' => $input,
        'secureHash' => $secureHash,
        'query' => $query,
    ]);
});
