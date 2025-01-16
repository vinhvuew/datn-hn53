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
        Schema::table('orders', function (Blueprint $table) {
            // Xóa cột voucher
            $table->dropColumn('voucher');

            // Xóa cột id_status
            $table->dropColumn('id_status');

            // Thêm cột id_voucher
            $table->unsignedBigInteger('id_voucher')->after('id_user'); // Thêm sau cột id_user

            // Thêm cột status_order
            $table->string('status_order')->after('id_voucher'); // Thêm sau cột id_voucher
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Thêm lại cột voucher
            $table->string('voucher')->nullable();

            // Thêm lại cột id_status
            $table->unsignedBigInteger('id_status')->after('id_user');

            // Xóa cột id_voucher
            $table->dropColumn('id_voucher');

            // Xóa cột status_order
            $table->dropColumn('status_order');
        });
    }
};
