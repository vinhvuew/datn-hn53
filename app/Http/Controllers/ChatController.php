<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\NewMessageReceived;
use App\Events\RoomActive;
use App\Events\RoomJoinedEvent;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //người dùng click để thêm phòng
    public function createOrRedirect(Request $request, $receiverId)
    {
        $room = Room::firstOrCreate(
            ['user_id' => auth()->id()]
        );

        return redirect()->route('chat.room', ['roomId' => $room->id, 'receiverId' => $receiverId]);
    }


    //hiển thị trong client
    public function showChatRoom($roomId, $receiverId)
    {
        // Tìm phòng chat bằng ID
        $room = Room::findOrFail($roomId);

        // Lấy tất cả tin nhắn trong phòng chat
        $messages = Message::where('room_id', $roomId)->get();

        // Cập nhật trạng thái 'is_active' thành true khi người dùng vào phòng
        $room->update([
            'is_active' => true
        ]);




        // Trả về view với các tham số cần thiết
        return view('client.chat.room', compact('roomId', 'receiverId', 'messages'));
    }


    //giửi tin nhắn
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'room_id' => $request->room_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message, $request->room_id))->toOthers();
        if (auth()->user()->role_id != 1) {  // Kiểm tra nếu role_id không phải là 1 (admin)
            event(new NewMessageReceived($request->message, auth()->user()->name));
        }

        return response()->json(['message' => $message]);
    }
    //thoát trong trang user
    public function outChat($roomId)
    {
        $room = Room::findOrFail($roomId);
        $room->update([
            'is_active' => false
        ]);

        return redirect()->route('home');
    }



    //đi đến phòng chat đang hoạt động
    public function listChatRooms()
    {
        // Lấy tất cả các phòng chat, sắp xếp theo thời gian gần nhất
        $rooms = Room::with('user')
            ->where('user_id', '!=', auth()->id())
            ->orderBy('updated_at', 'desc')->get();
        // Trả về view với danh sách phòng và tin nhắn
        return view('admin.chat.chat-admin', compact('rooms'));
    }



    public function showChatAdmin($roomId, $receiverId)
    {
        $rooms = Room::query()
            ->with([
                'user',
                'messages' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // Hiển thị 1 tin nhắn mới nhất
                }
            ])
            ->where('user_id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        $room = Room::findOrFail($roomId);

        $messages = Message::where('room_id', $roomId)->get();
        // dd($receiverId);
        return view('admin.chat.room-admin', compact('room', 'rooms', 'roomId', 'receiverId', 'messages'));
    }
}
