<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status_product extends Model

{
    use HasFactory;
    protected $fillable = [
        'code_color',
        'code_size',
        'name_status',

    ];
}
