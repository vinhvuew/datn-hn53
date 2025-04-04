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
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('chat.user.' . $this->message->user_id), // Gửi đến khách hàng
            new Channel('chat.admin'),                                  // Gửi đến admin
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'user_id' => $this->message->user_id,
            'is_admin' => $this->message->admin_id !== null,
        ];
    }
}