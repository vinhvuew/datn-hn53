<?php

use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Cột id tự động tăng
            $table->foreignIdFor(Variant::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();// Khóa ngoại liên kết với bảng variants
            $table->foreignIdFor(User::class)->constrained();
            $table->unsignedBigInteger('id_user'); // Khóa ngoại liên kết với bảng users
            $table->string('img'); // Hình ảnh của sản phẩm trong giỏ hàng
            $table->decimal('price', 15, 2); // Giá của sản phẩm trong giỏ hàng
            $table->integer('quantity'); // Số lượng sản phẩm trong giỏ hàng
            $table->timestamps(); // Cột created_at và updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
