<?php

use App\Models\Status_order;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id');

                $table->unsignedBigInteger('status_id');

                $table->decimal('total_price', 10, 2);

                $table->unsignedBigInteger('address_id');

                $table->string('payment_method');
                $table->string('payment_status')->default('pending');

                $table->timestamp('order_date')->useCurrent();

                $table->unsignedBigInteger('voucher_id');

                $table->timestamps();
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
