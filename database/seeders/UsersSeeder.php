<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'], // Check if username 'admin' exists
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Hashed password for security
                'role_id' => 1, // Admin role
            ]
        );

        // Another User
        DB::table('users')->updateOrInsert(
            ['username' => 'another'], // Check if username 'another' exists
            [
                'name' => 'Another User',
                'email' => 'another@example.com', // Unique email for this user
                'password' => Hash::make('password'), // Hashed password for security
                'role_id' => 2, // Another role for sales input
            ]
        );
    }
}
