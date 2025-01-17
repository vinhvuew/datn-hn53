<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image_gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
      'created_at',
       
       
    ];
    public $table = 'image_gallery';
    public $timestamp = true;
    protected $dates = ['deleted_at'];
    
}
