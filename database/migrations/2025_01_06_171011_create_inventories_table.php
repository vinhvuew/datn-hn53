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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('id_variant'); // Khóa ngoại liên kết với bảng variants
            $table->integer('quantity'); // Số lượng tồn kho
            $table->integer('restock_level'); // Mức tồn kho thấp nhất yêu cầu để nhập lại hàng
            $table->string('location'); // Vị trí lưu trữ hàng hóa
            $table->date('last_restock_date'); // Ngày nhập lại hàng gần nhất
            $table->timestamps(); // Cột created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('id_variant')->references('id')->on('variants')->onDelete('cascade');
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
