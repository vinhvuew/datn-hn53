<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminChatController extends Controller
{
    public function index()
    {
        // Lấy danh sách người dùng đã nhắn tin (dựa trên user_id duy nhất)
        $users = Message::select('user_id')
            ->distinct()
            ->with('user')
            ->get();

        return view('admin.chat.index', compact('users'));
    }

    public function show($user_id)
    {
        // Lấy tất cả tin nhắn giữa admin và người dùng cụ thể
        $messages = Message::where('user_id', $user_id)
            ->orWhere(function ($query) use ($user_id) {
                $query->where('admin_id', Auth::id())
                      ->where('user_id', $user_id);
            })
            ->with('user')
            ->get();

        return view('admin.chat.show', compact('messages', 'user_id'));
    }

    public function sendMessage(Request $request)
    {
        $admin = Auth::user();
        $message = Message::create([
            'user_id' => $request->user_id,
            'admin_id' => $admin->id,
            'message' => $request->message,
            'is_read' => false,
        ]);


        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => [
                'message' => $message->message,
                'user_id' => $message->user_id,
                'admin_id' => $message->admin_id,
                'is_admin' => $message->admin_id !== null,
            ]
        ]);
    }

    public function deleteChat($user_id)
{
    // Xóa vĩnh viễn tất cả tin nhắn của user với admin
    Message::where('user_id', $user_id)->delete();

    return redirect()->route('admin.chat.index')->with('success', 'Đoạn chat đã bị xoá vĩnh viễn.');
}

}
