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
    
    public function show($id)
    {
        // Giả sử bạn có một mảng tin nhắn hoặc lấy từ database
        $messages = [
            1 => 'Tin nhắn 1: Xin chào!',
            2 => 'Tin nhắn 2: Chúc bạn một ngày tốt lành!',
            3 => 'Tin nhắn 3: Bạn cần hỗ trợ gì',
            4 => 'Tin nhắn 4: Cảm ơn',
        ];

        if (!isset($messages[$id])) {
            abort(404, 'Tin nhắn không tồn tại.');
        }

        return view('mess.show', ['message' => $messages[$id]]);
    }
    public function update(Request $request, $id)
    {
        // Giả sử bạn cập nhật lại tin nhắn từ mảng (hoặc database)
        $messages = [
            1 => 'Tin nhắn 1: Xin chào!',
            2 => 'Tin nhắn 2: Chúc bạn một ngày tốt lành!',
            3 => 'Tin nhắn 3: Bạn cần hỗ trợ gì',
            4 => 'Tin nhắn 4: Cảm Ơn',
        ];

        if (!isset($messages[$id])) {
            abort(404, 'Tin nhắn không tồn tại.');
        }

        // Cập nhật tin nhắn
        $messages[$id] = $request->input('message');

        // Quay lại trang tin nhắn đã cập nhật
        return back()->with('status', 'Tin nhắn đã được cập nhật!');
    }
}
