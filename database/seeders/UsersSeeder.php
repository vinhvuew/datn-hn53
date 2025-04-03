<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Gọi seeder khác tại đây
        $this->call(UsersSeeder::class);
        // $this->call(OtherSeeder::class);
    }
}
