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
            'ekspedisi_nama' => "Kargo",
            'ekspedisi_jenis' => "Express",
            'users_id' => "1",
        ]);
    }
}
