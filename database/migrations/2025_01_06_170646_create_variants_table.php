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
        Schema::create('variants', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_product'); // Khóa ngoại liên kết với bảng products
            $table->unsignedBigInteger('id_status_product'); // Khóa ngoại liên kết với bảng status_products
            $table->decimal('price', 10, 2); // Cột giá sản phẩm (kiểu số thập phân)
            $table->string('sku')->unique(); // Cột mã SKU (mã duy nhất cho từng sản phẩm)
            $table->string('color'); // Cột màu sắc của sản phẩm
            $table->string('size'); // Cột kích cỡ của sản phẩm
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_status_product')->references('id')->on('status_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
