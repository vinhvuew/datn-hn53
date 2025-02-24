<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{

    const PATH_VIEW = 'Client.';

    public function home()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function room()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function products()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

  

    public function index() {
        // Lấy 8 sản phẩm mới nhất có cờ `is_new = true`
        $newProducts = Product::where('is_new', true) // Lọc sản phẩm mới
                              ->latest() // Sắp xếp theo thời gian tạo (mới nhất trước)
                              ->take(8) // Chỉ lấy 8 sản phẩm
                              ->get(); // Lấy dữ liệu từ database
    
        // Lấy 8 sản phẩm bán chạy nhất, sắp xếp theo số lượt xem (`view`) từ cao xuống thấp
        $bestSellingProducts = Product::orderBy('view', 'desc') // Sắp xếp theo lượt xem (bán chạy nhất trước)
                                      ->take(8) // Chỉ lấy 8 sản phẩm
                                      ->get(); // Lấy dữ liệu từ database
    
        // Trả dữ liệu về view `Client.Home`, truyền biến `$newProducts` và `$bestSellingProducts`
        return view('Client.Home', compact('newProducts', 'bestSellingProducts'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q'); // Lấy từ khóa từ thanh tìm kiếm

        // Tìm sản phẩm theo tên hoặc mô tả chứa từ khóa tìm kiếm
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

        return view('Client.SearchResults', compact('products', 'query'));
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
