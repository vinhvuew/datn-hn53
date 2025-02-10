<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view("admin.dashboard");
    }

    public function category()
    {
        return view("admin.categories.index");
    }

    public function product()
    {
        return view("admin.products.create");
    }

    public function detail()
    {
        return view("client.productDetail");
    }

    public function voucher()
    {
        return view("admin.Vouchers.view");
    }
    public function brands()
    {
        return view("admin.Brands.index");
    }
    public function User()
    {
        return view("admin.users.create");
    }
}
