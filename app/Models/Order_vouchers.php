<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_vouchers extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'discount_applied',


    ];
}
