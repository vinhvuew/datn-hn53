<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributes_value extends Model
{
    use HasFactory;
    protected $fillable = [
        'attributes_name_id',
        'value'
    ];

    public function attributeName()
    {
        return $this->belongsTo(attributes_name::class, 'attributes_name_id');
    }
}
