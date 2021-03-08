<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    protected $table = 'user_carts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'size'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function product(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function product_images(){
        return $this->hasMany('App\ProductImage', 'product_id', 'product_id');
    }

    public function product_size(){
        return $this->belongsTo('App\ProductSize', 'product_id', 'product_id');
    }
}
