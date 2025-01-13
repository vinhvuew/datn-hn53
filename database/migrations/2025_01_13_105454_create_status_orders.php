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
        Schema::create('status_orders', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->string('code'); // Cột mã (code)
            $table->string('name'); // Cột tên (name)
            $table->string('type'); // Cột loại (type)
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_orders');
    }
};
