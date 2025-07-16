<?php

use App\Http\Controllers\Frontend\Auth\GoogleAuthController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');


