<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'quantity',
        'total_amount',
    ];

    protected static function boot()
    {
        parent::boot();

        // Sự kiện "saving" sẽ được kích hoạt trước khi lưu bản ghi
        static::saving(function ($cartDetail) {
            // Nếu có `variant_id`, thì `product_id` phải là null
            if ($cartDetail->variant_id) {
                $cartDetail->product_id = null;
            }
            // Ngược lại, nếu không có `variant_id`, phải có `product_id`
            elseif ($cartDetail->product_id) {
                $cartDetail->variant_id = null;
            } else {
                throw new ModelNotFoundException('Cart item must have either a product_id or a variant_id.');
            }
        });
    }
    public function getTotalPriceAttribute()
    {
        return $this->quantity * ($this->variant->price_sale ?? $this->product->price_sale ?? 0);
    }




    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
