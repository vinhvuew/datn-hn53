<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        ProductReview::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
    
    public function update(Request $request, $id)
    {
        $review = ProductReview::findOrFail($id);

        // Kiểm tra người dùng có phải là người đã viết đánh giá không
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa đánh giá này.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $review->save();

        return redirect()->back()->with('success', 'Đã cập nhật đánh giá thành công!');
    }
}
