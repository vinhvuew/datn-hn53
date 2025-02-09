<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_deltail extends Model
{
    use HasFactory;
    protected $fillable = [
        'products_name',
        'quantity',
        'price',
    ];
}
