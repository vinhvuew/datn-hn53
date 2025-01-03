<?php

use App\Models\Orders;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' tự động tăng và là khóa chính
            // $table->foreignIdFor(Orders::class)->constrained(); 
            // $table->foreignIdFor(User::class)->constrained();
            $table->decimal('amount', 10, 2); // Tạo cột 'amount' để lưu số tiền thanh toán
            $table->string('payment_method'); // Tạo cột 'payment_method' để lưu phương thức thanh toán (ví dụ: "credit card", "paypal")
            $table->enum('payment_status', ['pending', 'completed', 'failed']); // Tạo cột 'payment_status' để lưu trạng thái thanh toán
            $table->dateTime('payment_date'); // Tạo cột 'payment_date' để lưu thời gian thanh toán
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
