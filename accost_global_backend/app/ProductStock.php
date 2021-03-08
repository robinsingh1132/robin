<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';
    protected $fillable = [
        'product_id',
        'product_size_id',
        'stock'
    ];
    public function product()
    {
        return $this->belongTo('App\Product','product_id');
    }
    public function size()
    {
        return $this->belongsTo('App\ProductSize','product_size_id');
    }
}