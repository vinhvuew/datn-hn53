<?php

use App\Models\Carts;
use App\Models\Products;
use App\Models\Variants;
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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính

            // Khóa ngoại liên kết với bảng products
            $table->foreignIdFor(Products::class)->constrained(); 
            
            // Khóa ngoại liên kết với bảng carts
            $table->foreignIdFor(Carts::class)->constrained(); 
            
            // Khóa ngoại liên kết với bảng variants
            $table->foreignIdFor(Variants::class)->constrained(); 

            // Cột price lưu giá sản phẩm
            $table->decimal('price', 10, 2); 
            
            // Số lượng sản phẩm
            $table->integer('quantity'); 
            
            // Timestamps
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
