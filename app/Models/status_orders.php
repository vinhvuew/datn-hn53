<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_name',
        'description',
        
       
    ];
}
