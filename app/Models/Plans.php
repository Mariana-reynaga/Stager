<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plans';

    protected $primaryKey = 'plan_id';

    protected $fillable = ['plan_name', 'plan_price'];
}
