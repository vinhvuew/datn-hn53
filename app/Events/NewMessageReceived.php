<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $userName;

    public function __construct($message, $userName)
    {
        $this->message = $message;
        $this->userName = $userName;
    }

    public function broadcastOn()
    {
        return new Channel('admin-notifications');
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user_name' => $this->userName,  // Truyền tên người dùng thay vì ID
        ];
    }
}
