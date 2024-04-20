<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Brian Viko Nura',
            'email' => 'vikonura@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'superadmin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sales',
            'email' => 'sales@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $this->call([
            JenisBarangSeeder::class,
        ]);

        $this->call([
            EkspedisiSeeder::class,
        ]);
    }
}
