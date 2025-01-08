<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Илья Проянников',
            'email' => 'ilya@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
            'phone_number' => '79205555522'
        ]);
    }
}
