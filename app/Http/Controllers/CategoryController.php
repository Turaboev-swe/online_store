<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

    public function create()
    {
        //
    }
    public function store(Request $request): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Foydalanuvchi autentifikatsiya qilinmagan.'
            ], 401);
        }

        $product = Product::query()->create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'message' => 'Categoriya yaratildi',
            'product' => $product,
        ], 201);
    }
}
