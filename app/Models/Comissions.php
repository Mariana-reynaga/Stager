<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comissions extends Model
{
    protected $table = 'comissions';

    protected $primaryKey = 'com_id';

    protected $fillable = ['com_title', 'com_description', 'com_client', 'com_due', 'is_complete','social_fk', 'payment_fk', 'user_id_fk', 'com_tasks', 'com_notes', 'com_percent'];

    public function casts(){
        return [
            'com_due' => 'date',
        ];
    }

    public function social(){
        return $this->belongsTo(SocialMedia::class, 'social_fk','id_social');
    }

    public function payment(){
        return $this->belongsTo(PaymentMethod::class, 'payment_fk','id_payment_method');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id_fk', 'user_id');
    }
}
