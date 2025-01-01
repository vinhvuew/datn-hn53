<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProduct(){
        return view('admin.pages.products.list');
    }
    public function addProduct(){
        return view('admin.pages.products.add');
    }
}
