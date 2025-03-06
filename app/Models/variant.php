<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'sku',
        'quantity',
        'image',
        'wholesale_price',
        'selling_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }
}
