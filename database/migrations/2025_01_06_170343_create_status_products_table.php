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
        Schema::create('status_products', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->string('code_color'); // Cột code_color (Mã màu sản phẩm)
            $table->string('code_size'); // Cột code_size (Mã kích cỡ sản phẩm)
            $table->string('name_status'); // Cột name_status (Tên trạng thái sản phẩm)
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_products');
    }
};
