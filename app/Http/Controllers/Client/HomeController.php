<?php

namespace App\Http\Controllers\Client;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    const PATH_VIEW = 'Client.';

    public function index()
    {
        $newProducts = Product::latest()->take(8)->get(); // 8 sản phẩm mới nhất
        $bestSellingProducts = Product::orderBy('sold', 'desc')->take(8)->get(); // 8 sản phẩm bán chạy nhất

        return view('home', compact('newProducts', 'bestSellingProducts'));
    }
}
