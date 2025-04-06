<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveRefund extends Model
{
    use HasFactory;
    protected $fillable = [
        'return_order_id',
        'image',
        'video',
    ];

    public function return_order()
    {
        $this->belongsToMany(ReturnOrder::class);
    }
}
