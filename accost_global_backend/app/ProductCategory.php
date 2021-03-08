<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = [
        'product_super_category_id',
        'name',
        'slug',
        'page_title',
        'seo_keywords',
        'seo_description',
        'icon',
        'is_featured',
        'status',
    ];

    public function superCategory()
    {
        return $this->belongsTo('App\ProductSuperCategory', 'product_super_category_id');
    }
    public function couponsCategory()
    {
        return $this->hasMany('App\CouponsCategory', 'categories_id');
    }
}