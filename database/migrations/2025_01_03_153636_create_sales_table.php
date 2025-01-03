<?php

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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            // $table->foreignIdFor(Products::class)->constrained(); 

            $table->date('start_date'); // Tạo cột 'start_date' kiểu date để lưu ngày bắt đầu chương trình khuyến mãi
            $table->date('end_date'); // Tạo cột 'end_date' kiểu date để lưu ngày kết thúc chương trình khuyến mãi
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
