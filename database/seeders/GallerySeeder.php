<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('galleries')->insert([
            [
                'pic_route' => 'gallery/FG2PiI6D1eKk6VS218CYPL1dPjdNZk47HprRcYFr.png',
                'com_id_fk' => 1
            ],
            [
                'pic_route' => 'gallery/kn9Q1A5V6RlLG85I1JBjZGtiGII2fo8GFduwJj4L.jpg',
                'com_id_fk' => 1
            ],
        ]);
    }
}
