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
                'user_id_fk' => 1,
                'com_title'=>'Gato payaso',
                'com_description'=>'Fullbody con fondo simple donde un gato con disfraz de payaso esta malabareando con pelotas de colores.',
                'social_fk'=>3,
                'pagos_fk'=>1,
                'com_client'=>'circus_lover',
                'com_entrega'=>'2025-12-01',
                'com_tasks' => '[{"task":"una", "is_complete": false}]',
                'com_notes'=>'[{"title": "nota 1", "note": "Esta es la primera nota!"}]',
                'is_complete'=> false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id_fk' => 1,
                'com_title'=>'Asirpa gk',
                'com_description'=>'retrato headshot de asirpa de Golden kamuy mirando para el costado. ',
                'social_fk'=>4,
                'pagos_fk'=>3,
                'com_client'=>'huevito',
                'com_entrega'=>'2025-12-03',
                'com_tasks' => '[{"task":"una2" , "is_complete":false}, {"task":"dos2", "is_complete":false} ]',
                'com_notes'=>'[]',
                'is_complete'=> false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id_fk' => 1,
                'com_title'=>'Retrato familiar Holenz',
                'com_description'=>'Retrato familiar de la familia holenz en el estilo de los simpson.',
                'social_fk'=>8,
                'pagos_fk'=>4,
                'com_client'=>'elenaSab@hotmail.com',
                'com_entrega'=>'2025-12-06',
                'com_tasks' => '[{"task":"una3", "is_complete":true}, {"task":"dos3", "is_complete":true}]',
                'com_notes'=>'[{"title": "nota 1", "note": "Esta es la primera nota!"}, {"title": "nota 2", "note": "Esta es la segunda nota!"}]',
                'is_complete'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id_fk' => 2,
                'com_title'=>'comision otro user',
                'com_description'=>'Retrato familiar de la familia holenz en el estilo de los simpson.',
                'social_fk'=>8,
                'pagos_fk'=>4,
                'com_client'=>'elenaSab@hotmail.com',
                'com_entrega'=>'2024-12-06',
                'com_tasks' => '[{"task":"una4", "is_complete":true}, {"task":"dos4", "is_complete":true}]',
                'com_notes'=>'[{"title": "nota 1", "note": "Esta es la primera nota!"}, {"title": "nota 2", "note": "Esta es la segunda nota!"}]',
                'is_complete'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
