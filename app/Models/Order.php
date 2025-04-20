<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const PENDING = "pending";
    const CONFIRMED = "confirmed";
    const SHIPPING = "shipping";
    const DELIVERED = "delivered";
    const COMPLETED = "completed";
    const CANCELED = "canceled";
    const ADMIN_CANCELED = "admin_canceled";
    protected $fillable = [
        'user_id',
        'total_price',
        'address_id',
        'payment_method',
        'payment_status',
        'order_date',
        'voucher_id',
        'voucher_code',
        'voucher_name',
        'voucher_discount_type',
        'voucher_discount_value',
        'voucher_discount_amount',
        'status',
        'completed_at'
    ];

    public static function getStatusList()
    {
        return [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Xác nhận',
            'shipping' => 'Chờ giao hàng',
            'delivered' => 'Đang giao hàng',
            'completed' => 'Giao hàng thành công',
            'order_confirmation' => 'Xác nhận đơn hàng',
            'canceled' => 'Người mua đã hủy',
            'admin_canceled' => 'Đã hủy bởi Admin',
            'return_request' => 'Yêu cầu trả hàng',
            'refuse_return' => 'Từ chối trả hàng',
            'sent_information' => 'Thông tin hoàn tiền',
            'return_approved' => 'Chấp nhận trả hàng',
            'returned_item_received' => 'Đã nhận được hàng trả lại',
            'refund_completed' => 'Hoàn tiền thành công'
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusList()[$this->status] ?? 'Không xác định';
    }

    public $timestamps = false;
    protected $dates = ['deleted_at'];

    //trong admin
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vouchers()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status_order::class, 'status_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class, 'order_id', 'id');
    }

}
