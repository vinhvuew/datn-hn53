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
            $table->id(); // Tạo cột id tự tăng
            $table->string('name'); // Cột tên người dùng
            $table->string('avata')->nullable(); // Cột tên người dùng
            $table->string('email')->unique(); // Cột email, đảm bảo không trùng
            $table->string('password'); // Cột mật khẩu
            $table->string('phone')->nullable(); // Cột số điện thoại, có thể null
            $table->enum('role',['user','admin']);
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
}
