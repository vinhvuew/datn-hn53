<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    const PATH_VIEW = 'Client.';

    public function home()
    {
        $latestProducts = Product::all();
        $discountedProducts = Product::all();
        $topSellingProducts = Product::all();
        $brands = Brand::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('latestProducts', 'discountedProducts', 'topSellingProducts', 'brands'));
    }


    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }

        if ($request->isMethod('post')) {
            // Xử lý logic cho POST request
            // Validate dữ liệu
            $validatedData = $request->validate([
                'address_id' => 'required',
                'payment_method' => 'required',
                // thêm các validation rules khác nếu cần
            ]);

            // Xử lý logic checkout và trả về response phù hợp
            return response()->json([
                'success' => true,
                'message' => 'Checkout successful'
            ]);
        }

        // Logic cho GET request (hiển thị form)
        $address = Address::where('user_id', Auth::id())->get();

        $cart = Cart::with(['cartDetails' => function ($query) {
            $query->where('is_selected', 1);
        }, 'cartDetails.product'])
            ->where('user_id', Auth::id())
            ->first();

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

        return view(self::PATH_VIEW . __FUNCTION__ . ".order", compact('totalAmount', 'payment_method', 'cart', 'address'));
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
