<?php

use App\Models\Oder_deltail;
use App\Models\Status_order;
use App\Models\User;
use App\Models\Voucher;
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
            $table->id(); // Cột id tự động tăng
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Status_order::class)->constrained();
            $table->foreignIdFor(Voucher::class)->constrained();
            $table->string('shipping_address'); // Cột địa chỉ giao hàng
            $table->decimal('total_price', 15, 3); // Cột tổng giá trị đơn hàng (2 chữ số sau dấu phẩy)
            $table->decimal('pay'); //  phương thức thanh toán
            $table->string('status_pay'); // Cột trạng thái thanh toán (Ví dụ: "Đã thanh toán", "Chưa thanh toán")
            $table->timestamps(); // Cột created_at và updated_at
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
