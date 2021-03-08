<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CouponsProduct;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = [
        'name',
        'sku',
        'brand_id',
        'product_details',
        'additional_details',
        'is_featured',
        'is_free_shipping',
        'is_review_allowed',
        'page_title',
        'seo_keywords',
        'seo_description',
        'product_page_slug',
        'attribute_set_value',
        'status',
    ];
    public function category_data()
    {
        return $this->hasOne('App\ProductCategorySubCategory', 'product_id');
    }
    public function subCategories()
    {
        return $this->hasOne('App\ProductCategorySubCategory','product_id');
    }

    public function product_type()
    {
        return $this->belongsTo('App\ProductType','tax_product_type_id','id');
    }
    public function related_product()
    {
        return $this->belongsTo('App\RelatedProduct','id','related_product_id');
    }
    public function product_image()
    {
        return $this->belongsTo('App\ProductImage','id','product_id');
    }
    public function couponsProduct()
    {
        return $this->hasMany('App\CouponsProduct','products_id');
    }
    public function productSize()
    {
        return $this->hasMany('App\ProductSize','product_id');
    }
    public function productSet()
    {
        return $this->hasOne('App\ProductSet','product_id');
    }
    public function productHighlight()
    {
        return $this->hasMany('App\ProductHighlight','product_id');
    }
    public function getRelatedProduct()
    {
        return $this->hasMany('App\RelatedProduct','product_id');
    }
    public function productTag()
    {
        return $this->hasMany('App\ProductTag','product_id');
    }
    public function productStock()
    {
        return $this->hasMany('App\ProductStock','product_id');
    }
    public function productmessage()
    {
        return $this->hasMany('App\Message','product_id');
    }
    public function order_details()
    {
        return $this->hasMany('App\OrderDetail','product_id');
    }
    public function order()
    {
        return $this->hasMany('App\Order','product_id');
    }
}
