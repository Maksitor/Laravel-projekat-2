<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            VrstaCokoladeSeeder::class,
            ProizvodSeeder::class,
            SirovinaSeeder::class,
            ProizvodniProcesSeeder::class,
            NarudzbinaSeeder::class,
            AdminUserSeeder::class, 
        ]);
    }
}
