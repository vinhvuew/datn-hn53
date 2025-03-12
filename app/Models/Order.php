<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status_id',
        'total_price',
        'address_id',
        'payment_method',
        'payment_status',
        'order_date',
        'voucher_id',
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





}
