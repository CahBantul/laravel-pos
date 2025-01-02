<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['code' => '001', 'name' => 'Elektronik'],
            ['code' => '002', 'name' => 'Fashion'],
            ['code' => '003', 'name' => 'Makanan'],
            ['code' => '004', 'name' => 'Kesehatan'],
            ['code' => '005', 'name' => 'Otomotif'],
            ['code' => '006', 'name' => 'Perabot'],
            ['code' => '007', 'name' => 'Perawatan Pribadi'],
            ['code' => '008', 'name' => 'Mainan'],
        ]);
    }
}
