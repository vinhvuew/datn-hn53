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
    public function checkout()
    {
        return view(self::PATH_VIEW.__FUNCTION__.".order");
    }
}
