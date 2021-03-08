<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CouponsCategory;
use App\CouponsProduct;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected  $fillable = [
        'coupon_type',
        'coupon_available_on',
        'name',
        'coupon_code',
        'coupon_description',
        'value',
        'duration',
        'repeating_days',
        'minimum_quantity',
        'maximum_quantity' ,
        'maximum_redemption' ,
        'start_date',
        'end_date',
        'status'
    ]; 

    public function coupon_products()
    {
        return $this->hasMany('App\CouponsProduct','coupons_id');
    } 
    public function coupon_categories()
    {
        return $this->hasMany('App\CouponsCategory');
    } 
}