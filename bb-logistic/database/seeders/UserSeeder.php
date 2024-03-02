<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => 'test@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(env('TEST_USER_PASSWORD')),
            'phone_number' => '79205553535',
            'remember_token' => Str::random(10),
        ]);

        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1]);
    }
}
