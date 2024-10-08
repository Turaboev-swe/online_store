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
        $users = User::findOrFail($id);
        
        return response()->json($users);
    }
}
