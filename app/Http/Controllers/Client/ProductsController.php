<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
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

        // Trả dữ liệu ra view
        return view('client.product.productDetail', compact('product', 'relatedProducts', 'totalStock'));
    }


    public function addToCart(Request $request)
    {
        try {
            // Lấy giỏ hàng của user (giả sử user_id = 1)
            $cart = Cart::firstOrCreate(['user_id' => 1]);

            $productId = $request->input('product_id');
            $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []);
            $quantity = (int) $request->input('quantity', 1);

            // Lấy sản phẩm từ cơ sở dữ liệu
            $product = Product::with('variants')->findOrFail($productId);

            // Kiểm tra giá sale từ session hoặc giá gốc
            $saleProduct = session('productsOnSale', collect([]))->firstWhere('id', $product->id);
            if ($product->price_sale) {
                $price = $saleProduct['price_sale'] ?? $product->price_sale;
            } else {
                $price = $product->base_price;
            }

            if (!empty($variantAttributeIds)) {
                // Nếu có biến thể, kiểm tra tồn kho của biến thể
                $attributeCount = count($variantAttributeIds);
                $variants = Variant::where('product_id', $productId)
                    ->whereHas('attributes', function ($query) use ($variantAttributeIds) {
                        $query->whereIn('attribute_value_id', $variantAttributeIds);
                    })
                    ->get();

                $matchingVariant = null;
                foreach ($variants as $variant) {
                    $variantAttributes = VariantAttribute::where('variant_id', $variant->id)
                        ->pluck('attribute_value_id')
                        ->toArray();

                    if (count(array_intersect($variantAttributes, $variantAttributeIds)) === $attributeCount) {
                        $matchingVariant = $variant;
                        break;
                    }
                }

                if (!$matchingVariant) {
                    return back()->with('error', 'Sản phẩm không còn hàng, vui lòng chọn sản phẩm khác!');
                }

                // Kiểm tra và cập nhật giỏ hàng
                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('variant_id', $matchingVariant->id)
                    ->first();
                $priceMod = $matchingVariant->price_modifier;

                if ($cartDetail) {
                    $newQuantity = $cartDetail->quantity + $quantity;
                    if ($matchingVariant->quantity < $newQuantity) {
                        return back()->with('error', 'Số lượng vượt quá tồn kho.');
                    }

                    $cartDetail->quantity = $newQuantity;
                    $cartDetail->total_amount += $priceMod * $quantity;
                    $cartDetail->save();
                } else {
                    if ($matchingVariant->quantity < $quantity) {
                        return back()->with('error', 'Số lượng vượt quá tồn kho.');
                    }

                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'variant_id' => $matchingVariant->id,
                        'quantity' => $quantity,
                        'total_amount' => $priceMod * $quantity,
                    ]);
                }

                // ✅ Trừ tồn kho biến thể
                $matchingVariant->decrement('quantity', $quantity);
            } else {
                // ❗ Xử lý sản phẩm KHÔNG có biến thể
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

                // ✅ Trừ tồn kho sản phẩm chính
                $product->decrement('quantity', $quantity);
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi.');
        }
    }
}
