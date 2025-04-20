<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'total_price',
        'product_name',
        'variant_attribute',
        'variant_value'
    ];

    // Mối quan hệ với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Mối quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Mối quan hệ với bảng Variant (nếu sản phẩm có biến thể)
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
