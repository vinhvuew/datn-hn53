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
            $table->string('email')->nullable()->unique();
            $table->string('password');  // Cột mật khẩu
            $table->string('phone')->nullable();  
            $table->enum('role', ['admin', 'user', 'moderator']);  
            $table->rememberToken();  
            $table->string('avata')->nullable(); // Cột tên người dùng
            $table->timestamps(); 
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
