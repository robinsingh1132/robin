<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HighlightsSubCategory extends Model
{
    protected $table = 'highlights_subcategories';
    protected $fillable = [
        'highlight_id',
        'product_subcategories_id',
        'product_categories_id',
        'status'
    ];
    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory','product_categories_id');
    }
    public function productSubCategory()
    {
        return $this->belongsTo('App\ProductSubcategory','product_subcategories_id');
    }
    public function highlight()
    {
        return $this->belongsTo('App\Highlight','highlight_id');
    }
}