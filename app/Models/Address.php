<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'province', // Lưu tên tỉnh
        'district', // Lưu tên huyện
        'ward', // Lưu tên xã
        'address',
        'note',
        'user_id',
        'is_default'
    ];
}