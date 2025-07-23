<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\UserController;
use App\Http\Controllers\Frontend\Api\CouponController as FrontendCouponController;


Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);


Route::prefix('v1')->group(function () {
    Route::get('/coupons', [FrontendCouponController::class, 'index']);
});



