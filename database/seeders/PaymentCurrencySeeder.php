<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_currencies')->insert([
            [
                'payment_currency_name' => 'ARS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_currency_name' => 'USD',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
