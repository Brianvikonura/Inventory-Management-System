<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ekspedisi::create([
            'ekspedisi_jenis' => "40 Fit",
            'ekspedisi_keterangan' => "Kargo Besar",
            'users_id' => "1",
        ]);

        \App\Models\Ekspedisi::create([
            'ekspedisi_jenis' => "20 Fit",
            'ekspedisi_keterangan' => "Kargo Kecil",
            'users_id' => "1",
        ]);
    }
}
