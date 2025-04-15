<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true, // Đặt giá trị là true cho admin
        ]);

        \App\Models\User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => false, // Đặt giá trị là false cho người dùng bình thường
        ]);
    }

}