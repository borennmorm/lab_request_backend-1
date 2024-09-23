<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'gender' => 'male',
            'phone' => '1234567890',
            'department' => 'Computer Science',
            'position' => 'Professor',
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'gender' => 'female',
            'phone' => '0987654321',
            'department' => 'Administration',
            'position' => 'System Administrator',
        ]);
    }
}
