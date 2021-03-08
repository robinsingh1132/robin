<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategorySubCategory extends Model
{
    protected $table = 'product_categories_subcategories';
    protected $fillable = [
        'super_category_id',
        'category_id',
        'subcategory_id',
        'product_id',
    ];
    public function super_category()
    {
        return $this->belongsTo('App\ProductSuperCategory' ,'super_category_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\ProductCategory');
    }
    public function subcategories()
    {
        return $this->belongsTo('App\ProductSubcategory' , 'subcategory_id');
    }
}