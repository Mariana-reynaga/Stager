<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    protected $table = 'comisiones';

    protected $primaryKey = 'com_id';

    protected $fillable = ['com_title', 'com_description', 'com_client', 'com_entrega', 'is_complete','social_fk', 'pagos_fk'];

    public function casts(){
        return [
            'com_entrega' => 'date'
        ];
    }

    public function social(){
        return $this->belongsTo(RedesSociales::class, 'social_fk','id_social');
    }

    public function pago(){
        return $this->belongsTo(MetodoPago::class, 'pagos_fk','id_metodo_pago');
    }
}
