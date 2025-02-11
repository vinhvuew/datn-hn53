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
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            $table->string('code')->unique(); // Tạo cột 'code' lưu mã giảm giá (đảm bảo mã giảm giá là duy nhất)
            $table->string('description')->nullable(); // Tạo cột 'description' để lưu mô tả voucher
            $table->enum('discount_type', ['fixed', 'percentage']); // Tạo cột 'discount_type' để xác định loại giảm giá (cố định hoặc theo tỷ lệ phần trăm)
            $table->decimal('discount_value', 10, 2); // Tạo cột 'discount_value' để lưu giá trị giảm giá
            $table->dateTime('start_date'); // Tạo cột 'start_date' để lưu ngày bắt đầu hiệu lực của voucher
            $table->dateTime('end_date'); // Tạo cột 'end_date' để lưu ngày hết hạn của voucher
            $table->integer('usage_limit'); // Tạo cột 'usage_limit' để lưu giới hạn số lần sử dụng của voucher
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
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
