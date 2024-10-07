<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/tokens/yaratish',function () {
    $user = User::query()->create([
        'name' => 'Yarat',
        'email' => 'yarat@gmail.com',
        'password' => Hash::make('yaratish')
    ]);
    $token = $user->createToken('MyApp')->plainTextToken;
    return response()->json(['token' => $token], 200);
});
