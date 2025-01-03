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
            // $table->foreignIdFor(Products::class)->constrained(); 
            // $table->foreignIdFor(Carts::class)->constrained(); 
            // $table->foreignIdFor(Variants::class)->constrained(); 
            $table->unsignedBigInteger('id_variant'); // Tạo cột 'id_variant' kiểu số nguyên không dấu, liên kết với bảng variants
            $table->decimal('price', 10, 2); // Tạo cột 'price' kiểu decimal để lưu giá sản phẩm
            $table->integer('quantity'); // Tạo cột 'quantity' kiểu số nguyên, lưu trữ số lượng sản phẩm trong giỏ hàng
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
          

         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crat_details');
    }
};
