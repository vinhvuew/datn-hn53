<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'price',
        'quantity',


    ];
    public function products()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
