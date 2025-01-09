<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function dashBoard(){
        return view('admin.pages.dashboard');   
    }
}
