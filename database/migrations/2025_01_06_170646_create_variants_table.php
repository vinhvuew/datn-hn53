<?php

use App\Models\Product;
use App\Models\status_products;
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
            $table->id(); // Cột id tự động tăng
            $table->foreignIdFor(Product::class)->constrained();
            $table->string('sku')->unique(); // Cột mã SKU (mã duy nhất cho từng sản phẩm)
            $table->string('image');
            $table->integer('quantity')->default(0);
            $table->decimal('wholesale_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);
            $table->timestamps();
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
