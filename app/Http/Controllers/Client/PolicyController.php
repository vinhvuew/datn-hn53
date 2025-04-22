<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Policy;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    // Hiển thị danh sách chính sách
    public function index()
    {
        // $policies = Policy::all();
        return view('client.policy.index',);
    }
}
