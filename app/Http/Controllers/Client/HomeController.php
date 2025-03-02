<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
class HomeController extends Controller
{

    const PATH_VIEW = 'Client.';

    public function home()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }


    public function checkout()
    {
       if(Auth::check()){
        $totalAmount = 1;
        $address = Address::where('user_id', Auth::id())->get();

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
        $products = [
            [
                'name' => 'Giày Nike ss2',
                'total' => 120000,
                'quantity' => 2,

            ],
            [
                'name' => 'Giày jordan ss2',
                'total' => 220000,
                'quantity' => 1,

            ],

        ];
        return view(self::PATH_VIEW . __FUNCTION__ . ".order", compact('totalAmount', 'payment_method', 'products','address'));
       }
       return view('client.home');

    }
    public function room()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function products()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }




    public function index()
    {

        $latestProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
        $topSellingProducts = Product::orderBy('view', 'desc')->take(8)->get();
        $brands = Brand::orderBy('created_at', 'desc')->take(4)->get();
        $discountedProducts = Product::whereColumn('price_sale', '<', 'base_price') // Lọc sản phẩm giảm giá
                                     ->orderBy('created_at', 'desc')
                                     ->take(9) // Lấy 9 sản phẩm (hiển thị 3 sản phẩm mỗi slide)
                                     ->get();


        return view('client.home', compact('latestProducts', 'topSellingProducts', 'brands', 'discountedProducts'));
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

    public function filter(Request $request)
    {
        $query = Product::query();

        // Lọc theo giá
        if ($request->filled('price')) {
            [$min, $max] = explode('-', $request->price . '-');
            if ($min !== '') {
                $query->where('base_price', '>=', (int)$min);
            }
            if ($max !== '') {
                $query->where('base_price', '<=', (int)$max);
            }
        }

        // Lọc theo size (giả sử có cột `size` trong bảng `products`)
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        // Lọc theo màu sắc (giả sử có cột `color` trong bảng `products`)
        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        $filteredProducts = $query->get();

        return view('client.filtered_products', compact('filteredProducts'));

    }

}
