<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $primaryKey = 'pic_id';

    protected $fillable = ['pic_route', 'com_id_fk'];

    public function comission(){
        return $this->belongsTo(Comissions::class, 'com_id_fk', 'com_id');
    }
}
