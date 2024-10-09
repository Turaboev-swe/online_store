<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }
    public function index_v1(): \Illuminate\Http\JsonResponse
    {
        $users = User::select('name','email')->get();
        return response()->json($users);
    }
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $users = User::query()->findOrFail($id);

        return response()->json($users);
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::query()->create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ]);
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'token'=>$user->createToken($user->name)->accessToken,
        ]);
    }
}
