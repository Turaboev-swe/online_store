<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommitController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Comment::all();
    }
    public function store(): JsonResponse
    {
        $comment = Comment::query()->create([
            'comment' => request('comment'),
            'user_id' => request('user_id'),
            'product_id' => request('product_id'),
        ]);
        return response()->json($comment);
    }
}
