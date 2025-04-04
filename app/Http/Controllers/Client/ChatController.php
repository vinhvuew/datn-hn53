<?php

namespace App\Http\Controllers\Client;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())->get();
        return view('client.chat.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_read' => false,
        ]);

        broadcast(new MessageSent($message));

        return response()->json([
            'success' => true,
            'message' => [
                'message' => $message->message,
                'user_id' => $message->user_id,
                'admin_id' => $message->admin_id,
                'is_read' => $message->is_read !== null,
            ]
        ]);
    }

}
