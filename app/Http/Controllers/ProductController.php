<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return response()->json($product);
    }
}
