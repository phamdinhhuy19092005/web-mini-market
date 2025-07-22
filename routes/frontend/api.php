<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\UserController;

Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);




