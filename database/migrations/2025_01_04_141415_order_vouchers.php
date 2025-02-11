<?php

use App\Models\Orders;
use App\Models\Voucher; // Đảm bảo tên model Voucher viết hoa
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_vouchers', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            $table->foreignIdFor(Orders::class)->constrained(); 
            $table->foreignIdFor(Voucher::class)->constrained(); // Chắc chắn sử dụng model 'Voucher' viết hoa
            $table->decimal('discount_applied', 10, 2); // Tạo cột 'discount_applied' kiểu decimal để lưu số tiền giảm giá đã áp dụng
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_vouchers');
    }
};
