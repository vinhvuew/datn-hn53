<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function listCart()
    {
        return view('client.cart.index'); // Điều hướng đến trang giỏ hàng
    }
}
