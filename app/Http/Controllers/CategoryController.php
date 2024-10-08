<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index():JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function show($id):JsonResponse
    {
        $categories = Category::query()->findOrFail($id);
        return response()->json($categories);
    }
}
