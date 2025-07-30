<?php

use App\Http\Controllers\Frontend\Auth\GoogleAuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('sham-pham')->group(function () {
    Route::get('{subcategory_slug}/{inventory_slug}', [ProductController::class, 'showByInventorySlug']);
});
