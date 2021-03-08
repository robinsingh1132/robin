<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
   	public function order_details()
    {
        return $this->hasOne('App\OrderDetail','order_id');
    }

}