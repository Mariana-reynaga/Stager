<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comisiones;
use App\Models\MetodoPago;
use App\Models\RedesSociales;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(
            [
                RedesSocialesSeeder::class,
                MetodoPagoSeeder::class,
                ComisionesSeeder::class,
            ]);
    }
}
