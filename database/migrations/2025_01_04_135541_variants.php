<?php

use App\Models\color;
use App\Models\Products;
use App\Models\size;
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
        Schema::create('variants', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
    
            $table->unsignedBigInteger('product_id'); // Khóa ngoại liên kết với bảng 'products'
            $table->unsignedBigInteger('color_id');   // Khóa ngoại liên kết với bảng 'colors'
            $table->unsignedBigInteger('size_id');    // Khóa ngoại liên kết với bảng 'sizes'
    
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->integer('quantity');     // Số lượng
            $table->string('sku')->unique(); // Mã sản phẩm duy nhất
            $table->string('img')->nullable(); // Hình ảnh sản phẩm
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
    
            // Định nghĩa khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};