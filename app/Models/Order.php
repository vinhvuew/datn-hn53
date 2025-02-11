<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_address',
        'total_price',
        'voucher',
        'pay',
        'status_pay',

    ];

    public $table = 'orders';
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function users()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function status_order()
{
    return $this->belongsTo(Status_order::class);
}

public function vouchers()
{
    return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
}

public function products()
{
    return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id')
                ->withPivot('name_product', 'quantity', 'price')
                ->withTimestamps();
}



}
