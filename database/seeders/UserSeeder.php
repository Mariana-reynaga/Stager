<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'                  => 'Tilla',
                'email'                 => 'test@admin.com',
                'password'              => \Hash::make('admin123'),
                'user_image'            =>'users/zvlZuV9Ngd2EueMSAddHhqXhphakbVKxSuZNnNEC.png',
                'email_verified_at'     => '2025-03-09 19:00:26',
                'sub_at'                => '2025-07-08',
                'end_sub'               => '2025-08-08',
                'created_at'            =>now(),
                'plan_id_fk'            => 1,
            ],
            [
                'name'                  => 'otro user',
                'email'                 => 'user@gmail.com',
                'password'              => \Hash::make('12345678'),
                'user_image'            => NULL,
                'email_verified_at'     => '2025-03-09 19:00:26',
                'sub_at'                => '2025-07-08',
                'end_sub'               => '2025-07-14',
                'created_at'            =>  now(),
                'plan_id_fk'            =>  1,
            ]
        ]);
    }
}
