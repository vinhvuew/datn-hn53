<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'discount_type',
        'discount_value',
        'min_order_value',
        'max_discount_value',
        'status',
        'start_date',
        'end_date',
    ];
};
