<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variants extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'sku',
        'color',
        'size',
       
    ];
}
