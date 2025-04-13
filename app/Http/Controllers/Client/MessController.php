<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessController extends Controller
{
    public function index()
    {
        return view('mess.index'); // Hiển thị trang mess/index.blade.php
    }

    public function send(Request $request)
    {
        $message = $request->input('message');

        // Xử lý lưu trữ hoặc gửi message ở đây
        return back()->with('status', 'Tin nhắn đã được gửi!');
    }
}
