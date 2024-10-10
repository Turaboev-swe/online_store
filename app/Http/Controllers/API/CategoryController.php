<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function create()
    {
        //
    }
    public function store(Request $request): JsonResponse
    {
        $category = Category::query()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'parent_id' => $request->get('parent_id'),
            'image' => $request->get('image')
        ]);
        return response()->json([
            'message' => 'Categoriya yaratildi',
            'product' => $category,
        ], 201);
    }
    public function update(Request $request, string $id): JsonResponse
    {
        $category = Category::query()->findOrFail($id);

        $category->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description'),
            'image' => $request->input('image')
        ]);

        return response()->json($category);
    }
    public function destroy(string $id): JsonResponse
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
