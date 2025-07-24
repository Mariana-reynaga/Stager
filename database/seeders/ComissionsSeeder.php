<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comissions')->insert([
            [
                'user_id_fk' => 1,
                'com_title'=>'Gato payaso',
                'com_description'=>'Fullbody con fondo simple donde un gato con disfraz de payaso esta malabareando con pelotas de colores.',
                'social_fk'=>3,
                'payment_fk'=>1,
                'com_client'=>'circus_lover',
                'currency_id_fk'=> 1,
                'com_price'=> 13500,
                'com_due'=>'2025-12-01',
                'com_tasks' => '[{"task":"tarea 1","is_complete":true},{"task":" tarea 2","is_complete":true},{"task":" tarea 3","is_complete":false},{"task":" tarea 4","is_complete":false},{"task":"tarea 5","is_complete":false}]',
                'com_percent'=>40,
                'com_notes'=>'[{"title": "nota 1", "note": "Esta es la primera nota!", "date": "22\/07\/2025 - 8:16 pm"}]',
                'is_complete'=> false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id_fk' => 1,
                'com_title'=>'Asirpa gk',
                'com_description'=>'retrato headshot de asirpa de Golden kamuy mirando para el costado. ',
                'social_fk'=>4,
                'payment_fk'=>3,
                'com_client'=>'huevito',
                'currency_id_fk'=> 1,
                'com_price'=> 13000,
                'com_due'=>'2025-12-03',
                'com_tasks' => '[{"task":"una2" , "is_complete":false}, {"task":"dos2", "is_complete":false} ]',
                'com_percent'=>0,
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
                'payment_fk'=>4,
                'com_client'=>'elenaSab@hotmail.com',
                'currency_id_fk'=> 2,
                'com_price'=> 500,
                'com_due'=>'2025-12-06',
                'com_tasks' => '[{"task":"una3", "is_complete":true}, {"task":"dos3", "is_complete":true}]',
                'com_percent'=>100,
                'com_notes'=>'[{"title": "nota 1", "note": "Esta es la primera nota!", "date": "22\/07\/2025 - 8:16 pm"}, {"title": "nota 2", "note": "Esta es la segunda nota!", "date": "22\/07\/2025 - 8:30 pm"}]',
                'is_complete'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id_fk' => 2,
                'com_title'=>'comision otro user',
                'com_description'=>'Retrato familiar de la familia holenz en el estilo de los simpson.',
                'social_fk'=>8,
                'payment_fk'=>4,
                'com_client'=>'elenaSab@hotmail.com',
                'currency_id_fk'=> 2,
                'com_price'=> 60,
                'com_due'=>'2024-12-06',
                'com_tasks' => '[{"task":"una4", "is_complete":true}, {"task":"dos4", "is_complete":true}]',
                'com_percent'=>100,
                'com_notes'=>'[]',
                'is_complete'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
