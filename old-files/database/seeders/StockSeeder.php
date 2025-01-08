<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock')->insert([
            'client_id' => 3,
            'name' => 'Рипстоп пончо синее (Унисекс, XS)',
            'color' => 'синий',
            'size' => 'XS',
            'vendor_code' => 'C00001S',
            'count' => 2
        ]);
    }
}
