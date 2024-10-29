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
                'user_id'=>1,
                'comm_title'=> 'Comision de ejemplo',
                'comm_short_desc'=> 'Esta es una comision de ejemplo. Para verificar que las tablas sean correctas',
                'comm_client_social'=> 'Pixiv' ,
                'comm_client'=> 'ejemplo_cliente',
                'due_date'=> '2016-11-01',
                'is_complete'=>false,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'user_id'=>1,
                'comm_title'=> 'Comision de ejemplo 2',
                'comm_short_desc'=> 'Esta es una comision de ejemplo. Para verificar que las tablas sean correctas',
                'comm_client_social'=> 'Pixiv' ,
                'comm_client'=> 'ejemplo_cliente',
                'due_date'=> '2016-11-01',
                'is_complete'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'user_id'=>1,
                'comm_title'=> 'Comision de ejemplo 3',
                'comm_short_desc'=> 'Esta es una comision de ejemplo. Para verificar que las tablas sean correctas',
                'comm_client_social'=> 'Pixiv' ,
                'comm_client'=> 'ejemplo_cliente',
                'due_date'=> '2016-11-01',
                'is_complete'=>false,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
    }
}
