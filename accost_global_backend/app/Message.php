<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
	protected $table = 'messages';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'receiver_role_id',
        'product_id',
        'coupon_code',
        'quantity',
        'title',
        'message',
        'is_read',
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','sender_id');
    }
   
        
}
