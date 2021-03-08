<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCategories extends Model
{
    protected $table = 'top_categories';
    protected $fillable = [
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo('App\ProductCategory','categories_id');
    }
}