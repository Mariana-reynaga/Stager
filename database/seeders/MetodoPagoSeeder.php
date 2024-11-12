<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metodo_pagos')->insert([
            [
                'metodo_pago'=>'Mercado Pago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metodo_pago'=>'Paypal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metodo_pago'=>'Efectivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metodo_pago'=>'Transferencia Bancaria',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
