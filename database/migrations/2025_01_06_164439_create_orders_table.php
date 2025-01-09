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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_user'); // Cột id_user (khóa ngoại liên kết với bảng users)
            $table->unsignedBigInteger('id_status'); // Cột id_status (khóa ngoại liên kết với bảng status_order)
            $table->string('shipping_address'); // Cột địa chỉ giao hàng
            $table->decimal('total_price', 10, 2); // Cột tổng giá trị đơn hàng (2 chữ số sau dấu phẩy)
            $table->string('voucher')->nullable(); // Cột voucher (có thể để trống)
            $table->decimal('pay', 10, 2); // Cột số tiền đã thanh toán
            $table->string('status_pay'); // Cột trạng thái thanh toán (Ví dụ: "Đã thanh toán", "Chưa thanh toán")
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_status')->references('id')->on('status_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
