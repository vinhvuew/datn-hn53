<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    const PATH_VIEW = 'Client.';

    public function home()
    {
        $featuredProducts = Product::where('is_active', 1)
            ->where('is_show_home', 1)
            ->latest()
            ->limit(8)
            ->get();

        $goodDeals = Product::where('is_active', 1)
            ->where('is_good_deal', 1)
            ->orderBy('price_sale', 'asc')
            ->limit(8)
            ->get();

        $newProducts = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
        // return response()->json($featuredProducts);
        return view(self::PATH_VIEW . __FUNCTION__, compact('featuredProducts', 'goodDeals', 'newProducts'));
    }



    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }

        if ($request->isMethod('post')) {
            // Chuyển hướng đến trang thanh toán
            return redirect()->route('checkout.view');
        }

        // Logic cho GET request (hiển thị form)
        $address = Address::where('user_id', Auth::id())->get();

        $cart = Cart::with([
            'cartDetails' => function ($query) {
                $query->where('is_selected', 1);
            },
            'cartDetails.product',
            'cartDetails.variant',  // eager load variant để có thông tin biến thể
            'cartDetails.variant.attributes',  // eager load variant attributes và attribute
            'cartDetails.variant.attributeValue', // eager load giá trị thuộc tính biến thể
            'cartDetails.variant.product' // eager load giá trị thuộc tính biến thể
        ])
            ->where('user_id', Auth::id())
            ->first();
            
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $cart_items = $cart->cartDetails->where('is_selected', 1);
            
        $totalAmount = CartDetail::where('cart_id', $cart->id)
            ->where('is_selected', 1)
            ->sum('total_amount');

        $payment_method = [
            [
                'name' => 'VNPAY',
                'value' => 'VNPAY_DECOD'
            ],
            [
                'name' => 'Thanh Toán Khi Nhận Hàng',
                'value' => 'COD'
            ],
        ];

        // Lấy danh sách voucher có hiệu lực
        $vouchers = Voucher::where('status', 'active')
        ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
        })
        ->whereNotIn('id', function($query) {
            $query->select('voucher_id')
                  ->from('orders')
                  ->whereNotNull('voucher_id')
                  ->where('user_id', Auth::id());
        })
        ->orderBy('min_order_value', 'asc')
        ->get();
    
        //  return response()->json($cart_items);
        return view(self::PATH_VIEW . __FUNCTION__ . ".order", compact('totalAmount', 'payment_method', 'cart', 'address', 'vouchers', 'cart_items'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q'); // Lấy từ khóa tìm kiếm từ form

        $searchResults = Product::where('name', 'LIKE', "%{$query}%") // Tìm theo tên sản phẩm
            ->orWhere('description', 'LIKE', "%{$query}%") // Tìm theo mô tả
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.searchResults', compact('searchResults', 'query'));
    }
}
