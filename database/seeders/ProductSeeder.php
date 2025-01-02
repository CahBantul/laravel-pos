<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'code' => 'P001',
                'name' => 'Smartphone',
                'quantity' => 100,
                'quantity_alert' => 10,
                'unit' => 'pcs',
                'cost' => 3000000,
                'price' => 4000000,
                'tax' => 11,
                'tax_type' => 1,
                'note' => 'Smartphone terbaru',
                'category_id' => 1, // Elektronik
            ],
            [
                'code' => 'P002',
                'name' => 'Kaos Polos',
                'quantity' => 200,
                'quantity_alert' => 20,
                'unit' => 'pcs',
                'cost' => 50000,
                'price' => 100000,
                'tax' => 11,
                'tax_type' => 1,
                'note' => 'Kaos polos untuk pria',
                'category_id' => 2, // Fashion
            ],
            [
                'code' => 'P003',
                'name' => 'Snack Keripik',
                'quantity' => 500,
                'quantity_alert' => 50,
                'unit' => 'pack',
                'cost' => 2000,
                'price' => 5000,
                'tax' => 11,
                'tax_type' => null,
                'note' => 'Keripik rasa pedas',
                'category_id' => 3, // Makanan
            ],
            [
                'code' => 'P004',
                'name' => 'Vitamin C',
                'quantity' => 150,
                'quantity_alert' => 15,
                'unit' => 'box',
                'cost' => 25000,
                'price' => 40000,
                'tax' => 111,
                'tax_type' => 1,
                'note' => 'Vitamin C untuk daya tahan tubuh',
                'category_id' => 4, // Kesehatan
            ],
            [
                'code' => 'P005',
                'name' => 'Oli Mesin',
                'quantity' => 80,
                'quantity_alert' => 5,
                'unit' => 'liter',
                'cost' => 50000,
                'price' => 75000,
                'tax' => 111,
                'tax_type' => 1,
                'note' => 'Oli mesin berkualitas',
                'category_id' => 5, // Otomotif
            ],
            [
                'code' => 'P006',
                'name' => 'Set Meja Makan',
                'quantity' => 30,
                'quantity_alert' => 5,
                'unit' => 'set',
                'cost' => 1500000,
                'price' => 2000000,
                'tax' => 111,
                'tax_type' => 1,
                'note' => 'Meja makan dari kayu jati',
                'category_id' => 6, // Perabot
            ],
            [
                'code' => 'P007',
                'name' => 'Shampoo',
                'quantity' => 100,
                'quantity_alert' => 10,
                'unit' => 'botol',
                'cost' => 30000,
                'price' => 50000,
                'tax' => 11,
                'tax_type' => 1,
                'note' => 'Shampoo untuk rambut sehat',
                'category_id' => 7, // Perawatan Pribadi
            ],
            [
                'code' => 'P008',
                'name' => 'Mainan Anak',
                'quantity' => 200,
                'quantity_alert' => 20,
                'unit' => 'pcs',
                'cost' => 20000,
                'price' => 40000,
                'tax' => 11,
                'tax_type' => null,
                'note' => 'Mainan edukasi untuk anak-anak',
                'category_id' => 8, // Mainan
            ],
        ]);
    }
}
