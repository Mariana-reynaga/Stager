<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedesSocialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('redes_sociales')->insert([
            [
                'red_social' => 'Instagram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Twitter / X',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Bluesky',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Facebook',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Ko-fi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Etsy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'V-Gen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'red_social' => 'Email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
