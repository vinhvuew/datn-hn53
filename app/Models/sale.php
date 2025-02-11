<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;
    protected $fillable=[
        'sale_price',
        'start_date',
        'end_date',
        

    ];
}
