<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comissions;
use App\Models\PaymentMethod;
use App\Models\SocialMedia;

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
                SocialMediaSeeder::class,
                PaymentMethodSeeder::class,
                PaymentCurrencySeeder::class,
                ComissionsSeeder::class,
                GallerySeeder::class,
            ]);
    }
}
