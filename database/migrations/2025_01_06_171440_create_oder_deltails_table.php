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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_order'); // Khóa ngoại liên kết với bảng orders
            $table->unsignedBigInteger('id_product'); // Khóa ngoại liên kết với bảng products
            $table->string('name_product'); // Tên sản phẩm
            $table->integer('quantity'); // Số lượng sản phẩm trong đơn hàng
            $table->decimal('price', 10, 2); // Giá sản phẩm trong đơn hàng
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oder_deltails');
    }
};
