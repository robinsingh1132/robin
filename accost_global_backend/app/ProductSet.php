<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSet extends Model
{
    protected $table = 'product_sets';
    protected $fillable = [
        'product_id',
        'product_size_id',
        'set_min',
        'set_max'
    ];
    public function productSetPrice()
    {
        return $this->hasMany('App\ProductSetPrice','product_id','product_size_id');
    }
}
