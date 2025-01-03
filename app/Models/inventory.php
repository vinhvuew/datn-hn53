<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    protected $fillable=[
        'quantity',
        'restock_lecel',
        'location',
        'lasr_restock_date',

    ];
}
