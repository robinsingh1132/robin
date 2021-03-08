<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductSuperCategory;
use App\Coupon;


class CouponsCategory extends Model
{
    protected $table = 'coupons_categories';
    protected $fillable = [
        'coupon_id',
        'super_category_id',
        'product_category_id',
        'sub_category_id',
        'status'
    ];
    public function superCategory()
    {
        return $this->belongsTo('App\ProductSuperCategory','super_category_id');
    }    
    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory','product_category_id');
    }    
    public function subCategory()
    {
        return $this->belongsTo('App\ProductSubcategory','sub_category_id');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Coupon','coupon_id');
    }
}
