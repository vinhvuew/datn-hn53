<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    const PATH_VIEW = 'Client.';

    public function cart()
    {
        try {
            // Kiểm tra nếu user chưa đăng nhập
            if (!Auth::check()) {
                return redirect()->route('home')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
            }

            $cart = Cart::where('user_id', Auth::id())->first();
            // dd($cart);
            // Nếu không có giỏ hàng, trả về danh sách rỗng
            $carts = $cart ? $cart->cartDetails()->with(['product', 'variant', 'variant.product', 'variant.attributes', 'variant.attributeValue'])->get() : [];
            // dd($cart);
            return view('client.cart.listCart', compact('carts'));
        } catch (\Exception $e) {
            // Ghi log lỗi nếu cần
            Log::error('Lỗi khi lấy giỏ hàng: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tải giỏ hàng. Vui lòng thử lại.');
        }
    }

    // public function update(Request $request, string $id)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'quantity' => 'required|integer|min:0',
    //     ]);
    //     // Lấy chi tiết giỏ hàng
    //     $cartDetail = CartDetail::query()->with('cart', 'variant')->findOrFail($id);

    //     if (!$cartDetail) {
    //         return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại!'], 404);
    //     }

    //     $variant = Variant::find($cartDetail->variant_id);
    //     $product = Product::find($cartDetail->product_id);
    //     // dd($product);
    //     if ($variant) {
    //         // Kiểm tra số lượng tồn kho
    //         if ($request->quantity > $variant->quantity) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Số lượng yêu cầu vượt quá tồn kho của sản phẩm.',
    //             ], 400);
    //         }
    //     }
    //     if ($product) {
    //         foreach ($product->variants as $variant) {
    //             // Kiểm tra số lượng tồn kho
    //             if ($request->quantity > $variant->quantity) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Số lượng yêu cầu vượt quá tồn kho của sản phẩm.',
    //                 ], 400);
    //             }
    //         }
    //     }

    //     // // Cập nhật số lượng và tổng số tiền
    //     // $cartDetail->quantity = $request->quantity;
    //     // $cartDetail->total_amount = $request->quantity * $request->selling_price; // Sử dụng giá đã tính toán
    //     // $cartDetail->save();
    //     // Cập nhật số lượng và tổng số tiền
    //     $cartDetail->quantity = $request->quantity;

    //     // Kiểm tra xem sản phẩm có biến thể hay không
    //     $price = $cartDetail->variant ? $cartDetail->variant->selling_price : $cartDetail->product->price_sale;

    //     // Tính tổng số tiền
    //     $cartDetail->total_amount = $request->quantity * $price;
    //     $cartDetail->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Cập nhật số lượng thành công!',
    //         'cartDetail' => [
    //             'quantity' => $cartDetail->quantity,
    //         ],
    //     ], 200);
    // }


    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy chi tiết giỏ hàng
        $cartDetail = CartDetail::query()->with('cart', 'variant')->findOrFail($id);

        if (!$cartDetail) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại!'], 404);
        }

        $variant = $cartDetail->variant;
        $product = $cartDetail->product;
        // dd($product);

        // Kiểm tra tồn kho
        if ($variant) {
            if ($request->quantity > $variant->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng yêu cầu vượt quá tồn kho!',
                ], 400);
            }
        }
        if ($product) {
            if ($request->quantity > $product->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng yêu cầu vượt quá tồn kho!',
                ], 400);
            }
        }


        $variant = $cartDetail->variant;
        $product = $cartDetail->product ?? ($variant ? $variant->product : null);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Lấy giá của sản phẩm, nếu có giảm giá thì dùng giá sale
        $price = $product->price_sale ?? $product->base_price;

        // Đảm bảo số lượng hợp lệ (>= 1)
        $quantity = max(1, (int) $request->quantity);

        // Cập nhật số lượng và tổng tiền
        $cartDetail->quantity = $quantity;
        $cartDetail->total_amount = $quantity * $price;
        $cartDetail->save();
        // Tính lại tổng tiền giỏ hàng
        $overallTotal = $cartDetail->cart->cartDetails->sum('total_amount');

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật số lượng thành công!',
            'totalAmountFormatted' => number_format($cartDetail->total_amount, 0, ',', '.') . ' VNĐ',
            'overallTotalFormatted' => number_format($overallTotal, 0, ',', '.') . ' VNĐ',
        ], 200);
    }

    public function destroy(string $id)
    {
        $cartDetail = CartDetail::query()->with('cart')->find($id);
        if (!$cartDetail) {
            return back()->with('error', 'Giỏ hàng không tồn tại!');
        }
        $cartDetail->delete();

        $overallTotal = $cartDetail->cart->cartDetails->sum('total_amount');

        // Lấy id giỏ hàng
        $cart = $cartDetail->cart;
        // Kiểm tra xem giỏ hàng còn chi tiết nào không
        if ($cart->cartDetails->count() === 0) {
            $cart->delete();
            return back()->with('error', 'Tất cả sản phẩm đã bị xóa khỏi giỏ hàng!');
        }
        return back()->with([
            'success' => 'Xóa sản phẩm thành công!',
            'overallTotalFormatted' => number_format($overallTotal, 0, ',', '.') . ' VNĐ'
        ]);
    }

    public function checkout(Request $request)
    {

        $selectedItems = $request->input('selected_items');

        if (!$selectedItems) {
            return response()->json(['success' => false, 'message' => 'Không có sản phẩm nào được chọn!']);
        }

        // Lưu sản phẩm vào session hoặc tiếp tục xử lý đặt hàng
        session(['checkout_items' => $selectedItems]);

        return response()->json(['success' => true]);
    }

    public function updateSelection(Request $request, $id)
    {
        $cartItem = CartDetail::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
        }

        $cartItem->update(['is_selected' => $request->is_selected]);

        return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
    }
}
