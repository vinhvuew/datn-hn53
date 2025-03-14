<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Khóa chính tự động tăng
            $table->string('name');  // Cột tên người dùng
            $table->string('address')->nullable();
            $table->string('email')->unique()->nullable();  // Cột email duy nhất
            $table->string('password');  // Cột mật khẩu
            $table->string('phone')->nullable();  // Cột số điện thoại, có thể null
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('verification_code')->nullable(); // Mã xác thực email
            $table->enum('role', ['admin', 'user', 'moderator']);  // Cột vai trò, mặc định là 'user'

            $table->rememberToken();  // Cột để lưu token "Remember me"
            $table->string('avatar')->nullable(); 
            $table->timestamps(); // Cột created_at và updated_at
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
