<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variant extends Model
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
        return $this->belongsToMany(attributes_name::class, 'variant_attributes')
            ->withPivot('attributes_value_id')
            ->withTimestamps();
    }
}
