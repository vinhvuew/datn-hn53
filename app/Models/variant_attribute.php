<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variant_attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'variant_id',
        'attribute_name_id',
        'attributes_value_id'
    ];

    public function variant()
    {
        return $this->belongsTo(variant::class);
    }

    public function attributeName()
    {
        return $this->belongsTo(attributes_name::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(attributes_value::class);
    }
}
