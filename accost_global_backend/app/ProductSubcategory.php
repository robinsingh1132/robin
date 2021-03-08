<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $table = 'product_subcategories';
    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'page_title',
        'seo_keywords',
        'seo_description',
        'icon',
        'is_featured',
        'status'
    ];

    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id');
    }
    public function highlight()
    {
        return $this->hasMany('App\HighlightsSubCategory','product_subcategories_id');
    }
}