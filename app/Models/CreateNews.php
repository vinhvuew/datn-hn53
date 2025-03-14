<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateNews extends Model
{
    use HasFactory;

    protected $table = 'create_news'; // Tên bảng trong database
    protected $fillable = ['title', 'content', 'image'];
    public $timestamps = true; // Bật timestamps để Laravel tự động thêm created_at & updated_at
}
