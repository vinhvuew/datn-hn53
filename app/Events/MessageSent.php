<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // Gửi tin nhắn đến kênh người dùng và admin
        return [
            new PrivateChannel('chat.user.' . $this->message->user_id),
            new Channel('chat.admin'),
        ];
    }

    public function broadcastWith()
    {
        // Thêm thông tin về tên người dùng, admin hoặc nhân viên hỗ trợ
        return [
            'message' => $this->message->message,
            'user_id' => $this->message->user_id,
            'is_admin' => $this->message->admin_id !== null,
            'user_name' => $this->message->user ? $this->message->user->name : 'User ' . $this->message->user_id,
            'role' => $this->message->admin_id && $this->message->user->role === 'support' ? 'support' : 'admin',
        ];
    }
}
