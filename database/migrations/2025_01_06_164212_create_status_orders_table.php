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
        Schema::create('status_orders', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->string('voucher')->nullable(); // Cột voucher (có thể để trống)
            $table->string('status_pay'); // Cột trạng thái thanh toán
            $table->string('payment_method'); // Cột phương thức thanh toán
            $table->string('name_status'); // Cột tên trạng thái đơn hàng
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_orders');
    }
};
