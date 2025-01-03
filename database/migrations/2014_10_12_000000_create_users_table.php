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
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Khóa chính tự động tăng
            $table->string('name');  // Cột tên người dùng
            $table->string('email')->unique();  // Cột email duy nhất
            $table->string('password');  // Cột mật khẩu
            $table->string('phone')->nullable();  // Cột số điện thoại, có thể null
            $table->enum('role', ['admin', 'user', 'moderator']);  // Cột vai trò, mặc định là 'user'
            $table->rememberToken();  // Cột để lưu token "Remember me"
            $table->timestamps();  // Tạo các cột created_at và updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};