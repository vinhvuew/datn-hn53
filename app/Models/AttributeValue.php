<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_id',
        'value'
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
