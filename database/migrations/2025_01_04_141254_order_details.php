<?php

use App\Models\Orders;
use App\Models\Products;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            $table->foreignIdFor(Orders::class)->constrained(); // Khóa ngoại liên kết với bảng 'orders'
            $table->foreignIdFor(Products::class)->constrained(); // Khóa ngoại liên kết với bảng 'products'
            
            $table->string('product_name'); // Tạo cột 'product_name' để lưu tên sản phẩm
            $table->integer('quantity'); // Tạo cột 'quantity' kiểu số nguyên để lưu số lượng sản phẩm
            $table->decimal('price', 10, 2); // Tạo cột 'price' kiểu decimal để lưu giá của sản phẩm
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
