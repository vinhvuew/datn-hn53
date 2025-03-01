<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    // Lấy danh sách bình luận theo sản phẩm
    public function show($productId)
    {
        $comments = Comment::where('product_id', $productId)
            ->whereNull('parent_id')
            ->with(['user', 'replies' => function ($query) {
                $query->with('user')->orderBy('created_at', 'asc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['comments' => $comments]);
    }

    // Lưu bình luận mới
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:variants,id',
            'parent_id' => 'nullable|exists:comments,id',
            'content' => 'required|string|max:500',
        ]);

        try {
            $comment = Comment::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'parent_id' => $request->parent_id,
                'content' => $request->content,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được đăng!',
                'comment' => [
                    'id' => $comment->id,
                    'user' => Auth::user()->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'parent_id' => $comment->parent_id,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi lưu bình luận: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    }
}
