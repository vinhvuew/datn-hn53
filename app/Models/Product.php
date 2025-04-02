<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'description',
        'content',
        'base_price',
        'price_sale',
        'img_thumbnail',
        'user_manual',
        'quantity',
        'view',
        'is_active',
        'is_good_deal',
        'is_new',
        'is_show_home',

    ];


    protected $casts = [
        'is_active' => 'boolean',
        'is_good_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(image_gallery::class);
    }

    /**
     * Quan hệ nhiều-nhiều với bảng Order thông qua bảng trung gian order_product
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'product_id', 'order_id')
            ->withPivot('name_product', 'quantity', 'price')
            ->withTimestamps();
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function getPriceAttribute()
    {
        return $this->price_sale ?? $this->base_price;
    }

    //
    public function favoritedByUsers() {
        return $this->belongsToMany(User::class, 'favorites');
    }

}
