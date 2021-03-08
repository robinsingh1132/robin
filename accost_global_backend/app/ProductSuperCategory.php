<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSuperCategory extends Model
{
    protected $table = 'product_super_categories';

    protected $fillable = [
        'name',
        'slug',
        'page_title',
        'seo_keywords',
        'seo_description',
        'icon',
        'is_featured',
        'status',
    ];        
}