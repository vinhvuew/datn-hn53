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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_brand'); // Cột id_brand (khóa ngoại liên kết với bảng brands)
            $table->unsignedBigInteger('id_category'); // Cột id_category (khóa ngoại liên kết với bảng categories)
            $table->unsignedBigInteger('id_img'); // Cột id_img (khóa ngoại liên kết với bảng image_gallery)
            $table->string('slug')->unique(); // Cột slug cho sản phẩm (để tạo URL thân thiện)
            $table->string('name'); // Cột tên sản phẩm
            $table->text('text'); // Cột mô tả sản phẩm
            $table->decimal('price', 10, 2); // Cột giá sản phẩm (2 chữ số sau dấu phẩy)
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('id_img')->references('id')->on('image_gallery')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
