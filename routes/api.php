<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class)
    ->middleware('auth:sanctum');

Route::resource('/categories', CategoryController::class)
    ->middleware('auth:sanctum');

Route::resource('/products', ProductController::class)
    ->middleware('auth:sanctum');
