<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Users API
Route::get('/user', function (Request $request) {return $request->user();})
    ->middleware('auth:api');
Route::get('/users',[UserController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('/users/{id}',[UserController::class,'show'])
    ->middleware('auth:sanctum');;
Route::post('/users/create',[UserController::class,'store'])
    ->middleware('auth:sanctum');

//Products API
Route::get('/products',[ProductController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('/products/{id}',[ProductController::class,'show'])
    ->middleware('auth:sanctum');
Route::post('/products/store',[ProductController::class,'store'])
    ->middleware('auth:sanctum');

//Categories API
Route::get('/category',[CategoryController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('/category/{id}',[CategoryController::class,'show'])
    ->middleware('auth:sanctum');
Route::post('/category/store',[CategoryController::class,'store'])
    ->middleware('auth:sanctum');




