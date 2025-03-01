<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function detail($slug)
    {
        // Lấy sản phẩm theo slug và load quan hệ cần thiết
        $product = Product::where('slug', $slug)
            ->with([
                'brand',
                'category',
                'images',
                'variants.attributes.attribute',
                'variants.attributes.attributeValue',
            ])
            ->firstOrFail();

        // Kiểm tra số lượng tồn kho
        if ($product->variants->isNotEmpty()) {
            // Nếu sản phẩm có biến thể, kiểm tra số lượng của từng biến thể
            $totalStock = $product->variants->sum('quantity');
        } else {
            // Nếu không có biến thể, lấy số lượng của sản phẩm chính
            $totalStock = $product->quantity;
        }

        // Lấy danh sách sản phẩm cùng danh mục (trừ sản phẩm hiện tại)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // Lấy danh sách bình luận
        $comments = Comment::where('product_id', $product->id)
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($comments);

        // Trả dữ liệu ra view
        return view('client.product.productDetail', compact('product', 'relatedProducts', 'totalStock', 'comments'));
    }

    public function addToCart(Request $request)
    {
        try {
            $cart = Cart::firstOrCreate(['user_id' => 1]);
            $productId = $request->input('product_id');
            $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []);
            $quantity = (int) $request->input('quantity', 1);

            $product = Product::with('variants')->findOrFail($productId);
            $saleProduct = collect(session('productsOnSale', []))->firstWhere('id', $product->id);
            $price = optional($saleProduct)['price_sale'] ?? $product->price_sale ?? $product->base_price;

            if (!empty($variantAttributeIds)) {
                $variant = Variant::where('product_id', $productId)
                    ->whereHas('attributes', function ($query) use ($variantAttributeIds) {
                        $query->whereIn('attribute_value_id', $variantAttributeIds);
                    }, '=', count($variantAttributeIds))
                    ->first();

                if (!$variant || $variant->quantity < $quantity) {
                    return back()->with('error', 'Sản phẩm không còn hàng hoặc số lượng vượt quá tồn kho!');
                }

                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('variant_id', $variant->id)
                    ->first();

                if ($cartDetail) {
                    $cartDetail->quantity += $quantity;
                    $cartDetail->total_amount += $variant->price_modifier * $quantity;
                    $cartDetail->save();
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'variant_id' => $variant->id,
                        'quantity' => $quantity,
                        'total_amount' => $variant->price_modifier * $quantity,
                    ]);
                }
                $variant->decrement('quantity', $quantity);
            } else {
                if ($product->quantity < $quantity) {
                    return back()->with('error', 'Số lượng vượt quá tồn kho.');
                }

                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartDetail) {
                    $cartDetail->quantity += $quantity;
                    $cartDetail->total_amount += $price * $quantity;
                    $cartDetail->save();
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'total_amount' => $price * $quantity,
                    ]);
                }
                $product->decrement('quantity', $quantity);
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi.');
        }
    }

    // public function addToCart(Request $request)
    // {
    //     try {
    //         // Lấy giỏ hàng của user (giả sử user_id = 1)
    //         $cart = Cart::firstOrCreate(['user_id' => 1]);

    //         $productId = $request->input('product_id');
    //         $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []);
    //         $quantity = (int) $request->input('quantity', 1);

    //         // Lấy sản phẩm từ cơ sở dữ liệu
    //         $product = Product::with('variants')->findOrFail($productId);

    //         // Kiểm tra giá sale từ session hoặc giá gốc
    //         $saleProduct = session('productsOnSale', collect([]))->firstWhere('id', $product->id);
    //         if ($product->price_sale) {
    //             $price = $saleProduct['price_sale'] ?? $product->price_sale;
    //         } else {
    //             $price = $product->base_price;
    //         }

    //         if (!empty($variantAttributeIds)) {
    //             // Nếu có biến thể, kiểm tra tồn kho của biến thể
    //             $attributeCount = count($variantAttributeIds);
    //             $variants = Variant::where('product_id', $productId)
    //                 ->whereHas('attributes', function ($query) use ($variantAttributeIds) {
    //                     $query->whereIn('attribute_value_id', $variantAttributeIds);
    //                 })
    //                 ->get();

    //             $matchingVariant = null;
    //             foreach ($variants as $variant) {
    //                 $variantAttributes = VariantAttribute::where('variant_id', $variant->id)
    //                     ->pluck('attribute_value_id')
    //                     ->toArray();

    //                 if (count(array_intersect($variantAttributes, $variantAttributeIds)) === $attributeCount) {
    //                     $matchingVariant = $variant;
    //                     break;
    //                 }
    //             }

    //             if (!$matchingVariant) {
    //                 return back()->with('error', 'Sản phẩm không còn hàng, vui lòng chọn sản phẩm khác!');
    //             }

    //             // Kiểm tra và cập nhật giỏ hàng
    //             $cartDetail = CartDetail::where('cart_id', $cart->id)
    //                 ->where('variant_id', $matchingVariant->id)
    //                 ->first();
    //             $priceMod = $matchingVariant->price_modifier;

    //             if ($cartDetail) {
    //                 $newQuantity = $cartDetail->quantity + $quantity;
    //                 if ($matchingVariant->quantity < $newQuantity) {
    //                     return back()->with('error', 'Số lượng vượt quá tồn kho.');
    //                 }

    //                 $cartDetail->quantity = $newQuantity;
    //                 $cartDetail->total_amount += $priceMod * $quantity;
    //                 $cartDetail->save();
    //             } else {
    //                 if ($matchingVariant->quantity < $quantity) {
    //                     return back()->with('error', 'Số lượng vượt quá tồn kho.');
    //                 }

    //                 CartDetail::create([
    //                     'cart_id' => $cart->id,
    //                     'variant_id' => $matchingVariant->id,
    //                     'quantity' => $quantity,
    //                     'total_amount' => $priceMod * $quantity,
    //                 ]);
    //             }

    //             // ✅ Trừ tồn kho biến thể
    //             $matchingVariant->decrement('quantity', $quantity);
    //         } else {
    //             // ❗ Xử lý sản phẩm KHÔNG có biến thể
    //             if ($product->quantity < $quantity) {
    //                 return back()->with('error', 'Số lượng vượt quá tồn kho.');
    //             }

    //             $cartDetail = CartDetail::where('cart_id', $cart->id)
    //                 ->where('product_id', $productId)
    //                 ->first();

    //             if ($cartDetail) {
    //                 $cartDetail->quantity += $quantity;
    //                 $cartDetail->total_amount += $price * $quantity;
    //                 $cartDetail->save();
    //             } else {
    //                 CartDetail::create([
    //                     'cart_id' => $cart->id,
    //                     'product_id' => $productId,
    //                     'quantity' => $quantity,
    //                     'total_amount' => $price * $quantity,
    //                 ]);
    //             }

    //             // ✅ Trừ tồn kho sản phẩm chính
    //             $product->decrement('quantity', $quantity);
    //         }

    //         return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return back()->with('error', 'Đã xảy ra lỗi.');
    //     }
    // }

    public function storeCommet(Request $request)
    {
        // dd($request->all());
        // $data = $request->validate([
        //     'product_id' => 'required|exists:products,id',
        //     'variant_id' => 'nullable|exists:variants,id',
        //     'parent_id' => 'nullable|exists:comments,id',
        //     'content' => 'required|string|max:500',
        // ]);
        // dd($data);
        try {
            $user = 1;
            Comment::create([
                'user_id' => $user,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'parent_id' => $request->parent_id,
                'content' => $request->content,
            ]);
            // return view('client.product.productDetail', compact('product', 'relatedProducts', 'totalStock', 'comments'));
            return back();
        } catch (\Exception $e) {
            Log::error('Lỗi lưu bình luận: ' . $e->getMessage());
            return back();
        }
    }

    // {
    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'variant_id' => 'nullable|exists:variants,id',
    //         'parent_id' => 'nullable|exists:comments,id',
    //         'content' => 'required|string|max:500',
    //     ]);

    //     try {
    //         // Tạo bình luận mới
    //         $user = 1;

    //         Comment::create([
    //             'user_id' => $user,
    //             'product_id' => $request->product_id,
    //             'variant_id' => $request->variant_id,
    //             'parent_id' => $request->parent_id,
    //             'content' => $request->content,
    //         ]);

    //         // Chuyển hướng về trang sản phẩm với thông báo thành công
    //         return redirect()->back()->with('success', 'Bình luận đã được đăng!');
    //     } catch (\Exception $e) {
    //         // Ghi log lỗi
    //         Log::error('Lỗi lưu bình luận: ' . $e->getMessage());

    //         // Chuyển hướng lại với thông báo lỗi
    //         return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
    //     }
    // }

    public function storeReply(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'required|exists:comments,id',
            'content' => 'required|string|max:500',
        ]);


        try {
            $user =1;
            $reply = Comment::create([
                'user_id' =>  $user,
                'product_id' => $request->product_id,
                'parent_id' => $request->parent_id,
                'content' => $request->content,
            ]);
            return back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
