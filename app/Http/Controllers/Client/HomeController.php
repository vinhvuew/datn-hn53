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
<<<<<<< HEAD
        $newProducts = Product::latest()->take(8)->get(); // 8 sản phẩm mới nhất
        $bestSellingProducts = Product::orderBy('sold', 'desc')->take(8)->get(); // 8 sản phẩm bán chạy nhất

        return view('home', compact('newProducts', 'bestSellingProducts'));
=======
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function checkout()
    {
        return view(self::PATH_VIEW.__FUNCTION__.".order");
>>>>>>> e6980c0b240b07e2f9690750e9e124f3bedb90aa
    }
}
