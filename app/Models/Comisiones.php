<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    protected $table = 'comisiones';

    protected $primaryKey = 'com-id';

    public function casts(){
        return [
            'com_entrega' => 'date'
        ];
    }
}
