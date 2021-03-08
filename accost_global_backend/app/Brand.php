<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected  $fillable = [
        'brand_name',
        'super_category_id',
        'slug',
        'icon',
        'status',
    ]; 

    public function superCategory()
    {
        return $this->belongsTo('App\ProductSuperCategory', 'super_category_id');
    }
}
