<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admins@gmail.com',
            'phone_number' => '081234567890',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'cashier',
            'email' => 'cashier@gmail.com',
            'phone_number' => '081234567891',
            'password' => bcrypt('12345678'),
            'role' => 'cashier'
        ]);
    }
}
