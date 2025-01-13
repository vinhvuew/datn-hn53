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
        // Xóa khóa ngoại từ bảng orders
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_status']); // Xóa khóa ngoại liên kết với bảng status_order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nếu muốn khôi phục lại, thêm khóa ngoại trở lại
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('id_status')->references('id')->on('status_order')->onDelete('cascade');
        });
    }
};
