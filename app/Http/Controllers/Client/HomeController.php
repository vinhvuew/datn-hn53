<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
        $brands = [
            [
                "name" => "Hải",
                "text" => "Thương hiệu số 1"
            ],
            [
                "name" => "Nam",
                "text" => "Uy tín và chất lượng"
            ],
            [
                "name" => "Linh",
                "text" => "Dẫn đầu xu hướng"
            ],
            [
                "name" => "An",
                "text" => "Giá tốt nhất thị trường"
            ]
        ];

        return view(self::PATH_VIEW . __FUNCTION__, compact('latestProducts', 'discountedProducts', 'topSellingProducts', 'brands'));
    }


    public function checkout()
    {

        if (Auth::check()) {
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
                    'name' => 'MOMO',
                    'value' => 'MOMO'
                ],
                [
                    'name' => 'Thanh Toán Khi Nhận Hàng',
                    'value' => 'COD'
                ],
            ];

            return view(self::PATH_VIEW . __FUNCTION__ . ".order", compact('totalAmount', 'payment_method', 'cart', 'address'));
        }
        return view('client.home');
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
