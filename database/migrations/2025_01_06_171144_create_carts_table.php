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
        Schema::create('cart', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_variant'); // Khóa ngoại liên kết với bảng variants
            $table->unsignedBigInteger('id_user'); // Khóa ngoại liên kết với bảng users
            $table->string('img'); // Hình ảnh của sản phẩm trong giỏ hàng
            $table->decimal('price', 10, 2); // Giá của sản phẩm trong giỏ hàng
            $table->integer('quantity'); // Số lượng sản phẩm trong giỏ hàng
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_variant')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
