<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'sender_id',
        'receiver_id',
        'message',
        'attachment',
        'attachment_type',

    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');  // Assuming the receiver is a user.
    }
}
