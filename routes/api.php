<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users',[UserController::class,'index']);

Route::get('/users/{id}',[UserController::class,'show']);

Route::get('/products',[ProductController::class,'index']);

Route::get('/products/{id}',[ProductController::class,'show']);

//Prefix for V1 api requests
Route::prefix('v1')->group(function () {
    Route::get('/users',[UserController::class,'index_v1']);
    Route::get('/users/{id}',[UserController::class,'show']);
});


