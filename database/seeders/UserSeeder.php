<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert users
        DB::table('users')->insert([
            [
                'name' => 'Teacher One',
                'email' => 'teacher1@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // teacher role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher Two',
                'email' => 'teacher2@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // teacher role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student One',
                'email' => 'student1@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // student role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // student role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
