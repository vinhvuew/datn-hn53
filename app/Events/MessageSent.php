<?php
namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {

        return [
            new Channel('chat.user.' . $this->message->user_id),
            new Channel('chat.admin'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'user_id' => $this->message->user_id,
            'admin_id' => $this->message->admin_id,
            'is_admin' => $this->message->admin_id !== null,
        ];

    }
}
