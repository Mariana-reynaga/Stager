<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    /** @use HasFactory<\Database\Factories\ComisionesFactory> */
    use HasFactory;

    protected $table = 'comisiones';

    protected $primaryKey = 'comm_id';

    protected $fillable =  ['user_id','comm_title', 'comm_short_desc', 'comm_client_social' ,'comm_client', 'due_date', 'is_complete'];

    public function casts(){
        return [
            'due_date' => 'datetime:Y-m-d'
        ];
    }
}
