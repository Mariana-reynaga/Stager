<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_media')->insert([
            [
                'social_media_name' => 'Instagram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Twitter / X',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Bluesky',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Facebook',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Ko-fi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Etsy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'V-Gen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social_media_name' => 'Email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
