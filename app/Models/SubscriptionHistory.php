<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    protected $table = 'subscription_histories';

    protected $primaryKey = 'sub_id';

    protected $fillable = [
        'MP_payment_id',
        'sub_start',
        'sub_end',
        'status',
        'user_id_fk'
    ];

    protected function casts(): array
    {
        return [
            'sub_start' => 'date',
            'sub_end'   => 'date'
        ];
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id_fk', 'user_id');
    }
}
