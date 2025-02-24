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
    //
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)
            ->with([
                'brand',
                'category',
                'images',
                'variants.attributes.attribute',
                'variants.attributes.attributeValue',
            ])
            ->firstOrFail();

        // Nhóm các thuộc tính theo loại
        $groupAttribute = [];
        foreach ($product->variants as $variant) {
            foreach ($variant->attributes as $attribute) {
                $attributeName = $attribute->attribute->name;
                $attributeValue = [
                    'id' => $attribute->attributeValue->id,
                    'name' => $attribute->attributeValue->value,
                ];

                // Thêm vào nhóm nếu chưa có
                if (!isset($groupAttribute[$attributeName])) {
                    $groupAttribute[$attributeName] = [];
                }

                if (!in_array($attributeValue, $groupAttribute[$attributeName])) {
                    $groupAttribute[$attributeName][] = $attributeValue;
                }
            }
        }

        return view('client.product.productDetail', compact('product', 'groupAttribute'));
    }

    public function addToCart(Request $request)
    {
        try {
            // dd($request->all());
            // $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' => 1]);

            $productId = $request->input('product_id');
            $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []);
            $quantity = $request->input('quantity', 1);

            // Lấy sản phẩm từ cơ sở dữ liệu
            $product = Product::find($productId);

            // Kiểm tra giá sale từ session
            // $productsOnSale = session('productsOnSale', []);
            // $saleProduct = collect($productsOnSale)->firstWhere('id', $product->id);

            // Lấy giá sale nếu có, nếu không thì dùng giá gốc
            if ($product->price_sale) {
                $price = $saleProduct['price_sale'] ?? $product->price_sale;
            } elseif ($product->base_price) {
                $price = $saleProduct['price_sale'] ?? $product->base_price;
            }


            if (!empty($variantAttributeIds)) {
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
                    return back()->with('error', 'Sản phẩm không còn hàng đó, vui lòng chọn sản phẩm khác!');
                }

                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('variant_id', $matchingVariant->id)
                    ->first();
                $priceMod = $matchingVariant->price_modifier;
                if ($cartDetail) {
                    $newQuantity = $cartDetail->quantity + $quantity;
                    if ($matchingVariant->quantity < $newQuantity) {
                        return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                    }

                    $cartDetail->quantity = $newQuantity;
                    $cartDetail->total_amount += $priceMod * $quantity; // Sử dụng price đã tính toán
                    $cartDetail->save();
                } else {
                    if ($matchingVariant->quantity < $quantity) {
                        return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                    }

                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'variant_id' => $matchingVariant->id,
                        'quantity' => $quantity,
                        'total_amount' => $priceMod * $quantity, // Sử dụng price đã tính toán
                    ]);
                }
            } else {
                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartDetail) {
                    $newQuantity = $cartDetail->quantity + $quantity;
                    foreach ($product->variants as $variant) {
                        if ($variant->stock < $newQuantity) {
                            return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                        }
                    }

                    $cartDetail->quantity = $newQuantity;
                    $cartDetail->total_amount += $price * $quantity; // Sử dụng price đã tính toán
                    $cartDetail->save();
                } else {
                    foreach ($product->variants as $variant) {
                        if ($variant->stock < $quantity) {
                            return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                        }
                    }

                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'total_amount' => $price * $quantity, // Sử dụng price đã tính toán
                    ]);
                }
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    
}
