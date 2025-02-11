<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'restock_level',
        'location',
        'last_restock_date'
    ];
}
