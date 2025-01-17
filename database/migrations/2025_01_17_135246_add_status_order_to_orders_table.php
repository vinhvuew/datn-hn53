<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOrderToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Thêm cột id_statusOrder liên kết với bảng status_orders
            $table->unsignedBigInteger('id_statusOrder')->nullable();

            // Định nghĩa khóa ngoại để kết nối với bảng status_orders
            $table->foreign('id_statusOrder')->references('id')->on('status_orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Xóa khóa ngoại và cột id_statusOrder
            $table->dropForeign(['id_statusOrder']);
            $table->dropColumn('id_statusOrder');
        });
    }
}
