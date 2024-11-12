<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComisionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comisiones')->insert([
            [
                'com_title'=>'Comision de ejemplo 1',
                'com_description'=>'Esta es una descripción para una comision de ejemplo. Sirve para verificar que todo funcione.',
                'com_client'=>'cliente-random',
                'com_entrega'=>'2024-12-01',
                'is_complete'=> false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'com_title'=>'Comision de ejemplo 2',
                'com_description'=>'Esta es una descripción para una comision de ejemplo. Sirve para verificar que todo funcione.',
                'com_client'=>'cliente-random',
                'com_entrega'=>'2024-12-03',
                'is_complete'=> false,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'com_title'=>'Comision de ejemplo 3',
                'com_description'=>'Esta es una descripción para una comision de ejemplo. Sirve para verificar que todo funcione.',
                'com_client'=>'cliente-random',
                'com_entrega'=>'2024-12-06',
                'is_complete'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
