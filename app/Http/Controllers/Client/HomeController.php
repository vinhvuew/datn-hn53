<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

}
