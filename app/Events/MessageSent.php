<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
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
            new PrivateChannel('chat.user.' . $this->message->user_id), // user nghe
            new Channel('chat.admin'), // admin nghe
        ];
    }


    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'user_id' => $this->message->user_id,
            'admin_id' => $this->message->admin_id,
            'is_admin' => $this->message->admin_id !== null,
            'user_name' => $this->message->user ? $this->message->user->name : 'User ' . $this->message->user_id,
            'timestamp' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
