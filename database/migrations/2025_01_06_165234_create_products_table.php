<?php

use App\Models\Brand;
use App\Models\Category;
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
            $table->id(); // Cột id tự động tăng
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Brand::class)->constrained();
            $table->text('name'); // Cột tên sản phẩm
            $table->string('sku');
            $table->string('slug')->unique(); // Cột slug cho sản phẩm (để tạo URL thân thiện)
            $table->text('description')->nullable(); // ~65,535 ký tự
            $table->longText('content')->nullable(); // ~4 tỷ ký tự
            $table->longText('user_manual')->nullable(); // ~4 tỷ ký tự
            $table->integer('quantity'); // số lượng
            $table->unsignedDecimal('base_price', 15, 2);
            $table->unsignedBigInteger('price_sale')->nullable();
            $table->string('img_thumbnail')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_good_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_show_home')->default(false);
            $table->timestamps(); // Cột created_at và updated_at
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
