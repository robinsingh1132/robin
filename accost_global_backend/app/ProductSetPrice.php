<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSetPrice extends Model
{
    protected $table = 'product_set_prices';
    protected $fillable = [
        'product_id',
        'product_size_id',
        'product_set_id',
        'set_min',
        'set_max',
        'price'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
    public function productSize()
    {
        return $this->belongsTo('App\ProductSize', 'product_size_id');
    }
}

