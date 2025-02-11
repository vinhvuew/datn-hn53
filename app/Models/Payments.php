<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = [
      
        'amount',
        'payment_method',
        'payment_status',
        'payment_date',
    ];

protected $acttributes =[
    'payment_status'=>'pending'
];
}
