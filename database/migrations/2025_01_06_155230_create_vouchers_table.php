<?php

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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự động tăng
            $table->string('code')->unique(); // Mã voucher, phải duy nhất
            $table->string('name'); // Tên voucher
            $table->enum('discount_type', ['percentage', 'fixed']); // Loại giảm giá
            $table->decimal('discount_value', 10, 2); // Giá trị giảm giá
            $table->decimal('min_order_value', 10, 2)->nullable(); // Giá trị đơn hàng tối thiểu (không bắt buộc)
            $table->decimal('max_discount_value', 10, 2)->nullable(); // Giới hạn giảm giá tối đa (không bắt buộc)
            $table->enum('status', ['active', 'expired', 'disabled']); // Trạng thái voucher
            $table->date('start_date')->nullable(); // Ngày bắt đầu áp dụng voucher
            $table->date('end_date')->nullable(); // Ngày hết hạn voucher
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
