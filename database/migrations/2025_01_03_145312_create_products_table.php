<?php

use App\Models\brands;
use App\Models\Category;
use App\Models\inventory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính

            $table->string('slug')->unique(); // Tạo cột 'slug' với kiểu chuỗi và yêu cầu duy nhất
            $table->string('name'); // Tạo cột 'name' với kiểu chuỗi
            $table->string('img')->nullable(); // Tạo cột 'img' kiểu chuỗi, có thể rỗng
            $table->text('mota')->nullable(); // Tạo cột 'mota' kiểu văn bản, có thể rỗng
            $table->decimal('price', 10, 2); // Tạo cột 'price' kiểu số thập phân với 10 chữ số, 2 chữ số thập phân
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
