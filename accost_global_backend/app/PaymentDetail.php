<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
   	public function user()
    {
        return $this->belongsTo('App\UserProfile','user_id','user_id');
    }
}
