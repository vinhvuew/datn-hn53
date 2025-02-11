<?php

use App\Models\Payments;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            $table->foreignIdFor(User::class)->constrained(); // Khóa ngoại liên kết với bảng 'users'
            $table->foreignIdFor(Payments::class)->constrained(); // Khóa ngoại liên kết với bảng 'payments'
           
            $table->string('shipping_address'); // Địa chỉ giao hàng
            $table->decimal('total_price', 10, 2); // Tổng giá trị đơn hàng
            $table->enum('status', ['pending', 'completed', 'cancelled', 'shipping']); // Trạng thái đơn hàng
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
