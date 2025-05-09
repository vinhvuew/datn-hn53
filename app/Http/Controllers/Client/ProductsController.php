<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

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
        // $comments = Comment::where('product_id', $product->id)
        //     ->whereNull('parent_id')
        //     ->with(['user', 'replies.user'])
        //     ->orderBy('created_at', 'desc')
        //     ->get();
        // // dd($comments);

        // Trả dữ liệu ra view
        return view('client.product.productDetail', compact('product', 'relatedProducts', 'totalStock', ));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Bạn cần đăng nhập để mua hàng!');
        }
        try {
            $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' =>  $user->id]);
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
                if ($variant->quantity < $quantity) {
                    return back()->with('error', 'Số lượng vượt quá tồn kho.');
                }

                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('variant_id', $variant->id)
                    ->first();

                if ($cartDetail) {
                    if (($quantity + $cartDetail->quantity) > $variant->quantity) {
                        return back()->with('error', 'Số lượng vượt quá tồn kho.');
                    }
                }

                if ($cartDetail) {
                    $cartDetail->quantity += $quantity;
                    $cartDetail->total_amount += $price * $quantity;
                    // $cartDetail->total_amount += $variant->selling_price * $quantity;
                    $cartDetail->save();
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'variant_id' => $variant->id,
                        'quantity' => $quantity,
                        'total_amount' => $price * $quantity,
                        // 'total_amount' => $variant->selling_price * $quantity,
                    ]);
                }

                // $variant->decrement('quantity', $quantity);
            } else {
                if ($product->quantity < $quantity) {
                    return back()->with('error', 'Số lượng vượt quá tồn kho.');
                }

                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();
                if ($cartDetail) {
                    if (($quantity + $cartDetail->quantity) > $product->quantity) {
                        return back()->with('error', 'Số lượng vượt quá tồn kho.');
                    }
                }
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
                // $product->decrement('quantity', $quantity);
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi.');
        }
    }

    public function storeCommet(Request $request)
    {
        try {
            $user = Auth::user();
            Comment::create([
                'user_id' => $user->id, // Chỉ truyền ID của user
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'parent_id' => $request->parent_id,
                'content' => $request->content,
            ]);
            return back();
        } catch (\Exception $e) {
            Log::error('Lỗi lưu bình luận: ' . $e->getMessage());
            return back();
        }
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'required|exists:comments,id',
            'content' => 'required|string|max:500',
        ]);

        try {
            $user = Auth::id(); // Lấy ID của user đang đăng nhập

            if (!$user) {
                return back()->with('error', 'Bạn cần đăng nhập để trả lời bình luận.');
            }

            Comment::create([
                'user_id' => $user,
                'product_id' => $request->product_id,
                'parent_id' => $request->parent_id,
                'content' => $request->content,
            ]);

            return back()->with('success', 'Trả lời bình luận thành công.');
        } catch (\Throwable $th) {
            Log::error('Lỗi lưu bình luận: ' . $th->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }


    // tùng bún
    public function statistical(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        // Khởi tạo query
        $query = Product::query()->where('is_active', 1);

        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo thương hiệu
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Lọc theo khoảng giá dựa vào price_sale
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '1':
                    $query->where('price_sale', '<', 500000);
                    break;
                case '2':
                    $query->whereBetween('price_sale', [500000, 1999000]);
                    break;
                case '3':
                    $query->whereBetween('price_sale', [2000000, 10000000]);
                    break;
            }
        }

        // Lấy danh sách sản phẩm theo phân trang
        $products = $query->latest()->paginate(12);

        return view('client.product.products', compact('products', 'categories', 'brands'));
    }


    // yêu thích
    public function favorite()
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('error', 'Bạn cần đăng nhập để xem danh sách yêu thích.');
        }

        $favorites = Auth::user()->favoriteProducts()->get();

        return view('client.product.favorites', compact('favorites'));
    }


    public function storefavorite(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('error', 'Bạn cần đăng nhập để thêm vào yêu thích.');
        }

        $user = Auth::user();
        $product_id = $request->input('product_id');

        if (!$user->favoriteProducts()->where('product_id', $product_id)->exists()) {
            $user->favoriteProducts()->attach($product_id);
            return redirect()->back()->with('success', 'Đã thêm vào danh sách yêu thích.');
        }

        return redirect()->back()->with('error', 'Sản phẩm đã có trong danh sách yêu thích.');
    }

    public function destroyfavorite($id) {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('error', 'Bạn cần đăng nhập để xóa sản phẩm yêu thích.');
        }

        $user = Auth::user();
        $user->favoriteProducts()->detach($id);

        return redirect()->back()->with('success', 'Đã xóa khỏi danh sách yêu thích.');
    }

}
