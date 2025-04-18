<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;



class VariantAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'variant_id',
        'attributes_name_id',
        'attributes_value_id',
        'attribute_id',
        'attribute_value_id',
    ];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
