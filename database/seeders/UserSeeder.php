<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        //     'phone' => '123456789',
        //     'role' => 'admin',
        // ]);

        // User::create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('password'),
        //     'phone' => '987654321',
        //     'role' => 'user',
        // ]);
    }
}
