<?php

use App\Models\Products;
use App\Models\User;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
           
            // $table->foreignIdFor(User::class)->constrained(); 
            // $table->foreignIdFor(Products::class)->constrained(); 
            $table->integer('quantity'); // Tạo cột 'quantity' kiểu số nguyên, lưu trữ số lượng sản phẩm trong giỏ hàng
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'

          
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
