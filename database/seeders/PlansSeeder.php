<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'plan_name' => 'Premium',
                'plan_price' => 4000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'plan_name' => 'Prueba',
                'plan_price' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
