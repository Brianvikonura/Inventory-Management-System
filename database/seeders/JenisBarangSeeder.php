<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\JenisBarang::create([
            'jenisbarang_nama' => "Sepeda Motor",
            'jenisbarang_slug' => "Sepeda Motor",
            'jenisbarang_keterangan' => "Indonesia Domestic Market",
        ]);

        \App\Models\JenisBarang::create([
            'jenisbarang_nama' => "Spare Part Motor",
            'jenisbarang_slug' => "Spare Part Motor",
            'jenisbarang_keterangan' => "100% original",
        ]);

        \App\Models\JenisBarang::create([
            'jenisbarang_nama' => "Aksesoris Motor",
            'jenisbarang_slug' => "Aksesoris Motor",
            'jenisbarang_keterangan' => "Tersedia untuk motor Jepang dan Italia",
        ]);
    }
}
