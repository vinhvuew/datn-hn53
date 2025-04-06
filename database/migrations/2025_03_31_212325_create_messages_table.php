<?php

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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Người gửi (user)
            $table->unsignedBigInteger('admin_id')->nullable(); // Admin liên quan (nếu là tin nhắn từ/to admin)
            $table->text('message'); // Nội dung tin nhắn
            $table->softDeletes();
            $table->boolean('is_read')->default(false); // Tin nhắn đã đọc chưa
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
