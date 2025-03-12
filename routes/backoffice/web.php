<?php

use App\Http\Controllers\Backoffice\DashboardController;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Fortify::loginView(fn() => view('backoffice.auth.login'));
Fortify::registerView(fn() => view('backoffice.auth.login'));

// backoffice 