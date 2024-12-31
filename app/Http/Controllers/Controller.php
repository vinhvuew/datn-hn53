<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view("client.index");
    }

    public function product()
    {
        return view("client.products");
    }

    public function cart()
    {
        return view("client.cart");
    }

    public function detail()
    {
        return view("client.productDetail");
    }
}
