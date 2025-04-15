<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $roomId;

    public function __construct(Message $message, $roomId)
    {
        $this->message = $message;
        $this->roomId = $roomId;
    }

    // Kênh Presence Channel để theo dõi trạng thái online của 2 người dùng
    public function broadcastOn()
    {
<<<<<<< HEAD
        return [
            new PrivateChannel('chat.user.' . $this->message->user_id),
            new Channel('chat.admin'),
        ];
=======
        return new PresenceChannel('chat.' . $this->roomId);
>>>>>>> c1557a8962642ef5782435c9b41c057ce522089e
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
<<<<<<< HEAD
            'user_id' => $this->message->user_id,
            'is_admin' => $this->message->admin_id !== null,
            'user_name' => $this->message->user ? $this->message->user->name : 'User ' . $this->message->user_id,
=======
            'sender_id' => $this->message->sender_id,
            'receiver_id' => $this->message->receiver_id,
>>>>>>> c1557a8962642ef5782435c9b41c057ce522089e
        ];
    }
}
