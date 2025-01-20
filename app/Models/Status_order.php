<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'voucher',
        'status_pay',
        'payment_method',
        'name_status',
       
    ];
}
