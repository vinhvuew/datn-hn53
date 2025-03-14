<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_price',
        'address_id',
        'payment_method',
        'payment_status',
        'order_date',
        'voucher_id',
        'status'
    ];

    public static function getStatusList()
    {
        return [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Xác nhận',
            'shipping' => 'Chờ giao hàng',
            'delivered' => 'Đang giao hàng',
            'completed' => 'Giao hàng thành công',
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

    public $table = 'orders';
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
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
}
