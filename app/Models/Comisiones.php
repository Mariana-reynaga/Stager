<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    protected $table = 'comisiones';

    protected $primaryKey = 'com_id';

    protected $fillable = [];

    public function casts(){
        return [
            'com_entrega' => 'date'
        ];
    }
}
