<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_address',
        'total_price',
        'voucher',
        'pay',
        'status_pay',
       
    ];
    
    public $table = 'orders';
    public $timetamp = false;
    protected $dates = ['deleted_at'];
}
