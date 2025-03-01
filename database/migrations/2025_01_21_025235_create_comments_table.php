<?php

use App\Models\Comment;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Quan hệ tự tham chiếu
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); // Người dùng
            $table->foreignIdFor(Product::class)->nullable()->constrained()->cascadeOnDelete(); // Sản phẩm
            $table->foreignIdFor(Variant::class)->nullable()->constrained()->cascadeOnDelete(); // Biến thể
            $table->text('content'); // Nội dung bình luận
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commens');
    }
};
