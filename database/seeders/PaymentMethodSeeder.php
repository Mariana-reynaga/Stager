<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'payment_method_name'=>'Mercado Pago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name'=>'Paypal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name'=>'Efectivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name'=>'Transferencia Bancaria',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
