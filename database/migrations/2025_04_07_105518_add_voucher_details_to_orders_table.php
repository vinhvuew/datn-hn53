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
            $table->string('voucher_code')->nullable()->after('voucher_id');
            $table->string('voucher_name')->nullable()->after('voucher_code');
            $table->enum('voucher_discount_type', ['percentage', 'fixed'])->nullable()->after('voucher_name');
            $table->decimal('voucher_discount_value', 15, 2)->nullable()->after('voucher_discount_type');
            $table->decimal('voucher_discount_amount', 15, 2)->nullable()->after('voucher_discount_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'voucher_code',
                'voucher_name',
                'voucher_discount_type',
                'voucher_discount_value',
                'voucher_discount_amount'
            ]);
        });
    }
};
