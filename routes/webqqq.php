<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

Route::get('/', function () {
    return view('welcome');
});
Fortify::loginView(fn() => view('auth.login'));
Fortify::registerView(fn() => view('auth.register'));
Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot-password'));

