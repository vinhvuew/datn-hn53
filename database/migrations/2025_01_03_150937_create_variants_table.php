<?php

use App\Models\color;
use App\Models\Products;
use App\Models\size;
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
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            
            // $table->foreignIdFor(Products::class)->constrained(); 
            // $table->foreignIdFor(color::class)->constrained(); 
            // $table->foreignIdFor(size::class)->constrained(); 
            $table->decimal('price', 10, 2); // Tạo cột 'price' kiểu số thập phân với 10 chữ số, 2 chữ số thập phân
            $table->integer('quantity'); // Tạo cột 'quantity' kiểu số nguyên
            $table->string('sku')->unique(); // Tạo cột 'sku' kiểu chuỗi, yêu cầu duy nhất
           
            $table->string('img')->nullable(); // Tạo cột 'img' kiểu chuỗi, có thể rỗng
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'

          
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
