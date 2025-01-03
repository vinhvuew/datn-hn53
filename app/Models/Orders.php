<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'shipping_address',
        'total_price',
        'status',


    ];
    protected $acttributes =[
        'status'=>'pending'
    ];
}
