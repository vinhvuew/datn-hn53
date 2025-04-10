<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $orderId;
    public $newStatus;
    public $userName;

    public function __construct($orderId, $newStatus, $userName = null)
    {
        $this->orderId = $orderId;
        $this->newStatus = $newStatus;
        $this->userName = $userName;
    }

    public function broadcastOn()
    {
        return new Channel('orders');
    }
}
