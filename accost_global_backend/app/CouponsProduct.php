<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class CouponsProduct extends Model
{
    protected $table = 'coupons_products';
    protected $fillable = [
        'coupons_id',
        'products_id',
        'status'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product','products_id');
    }  

    public function coupon(){
        return $this->belongsTo('App\Coupon','coupons_id');
    }

}