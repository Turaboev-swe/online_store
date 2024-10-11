<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class)
    ->middleware('auth:sanctum');

Route::resource('/categories', CategoryController::class)
    ->middleware('auth:sanctum');

Route::resource('/products', ProductController::class)
    ->middleware('auth:sanctum');

//Route::get('category/{id}/products', [ProductController::class, 'showbycategory']);

Route::get('/category/{id}/products', function (string $id) {
    return new ProductResource(Product::query()->findOrFail($id));
});
