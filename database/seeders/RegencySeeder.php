<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path ke file SQL
        $sqlPath = database_path('seeders/data/laravel_pos_regencies.sql');

        // Cek apakah file SQL ada
        if (File::exists($sqlPath)) {
            // Baca isi file SQL
            $sql = File::get($sqlPath);

            // Jalankan isi file SQL
            DB::unprepared($sql);

            $this->command->info('Regencies data seeded successfully!');
        } else {
            $this->command->error('File SQL tidak ditemukan.');
        }
    }
}
