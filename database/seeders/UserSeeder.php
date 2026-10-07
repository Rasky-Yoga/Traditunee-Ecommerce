<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'Admin',
            'email' => 'admin@alatmusik.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Customer Accounts
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);
    }
}
