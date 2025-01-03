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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            $table->integer('quantity'); // Tạo cột 'quantity' kiểu số nguyên, lưu trữ số lượng
            $table->integer('restock_level'); // Tạo cột 'restock_level' kiểu số nguyên, mức tồn kho yêu cầu
            $table->string('location'); // Tạo cột 'location' kiểu chuỗi, để lưu trữ vị trí kho
            $table->date('last_restock_date'); // Tạo cột 'last_restock_date' kiểu ngày tháng, ngày nhập lại kho gần nhất
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
