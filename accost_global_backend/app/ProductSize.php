<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';
    protected $fillable = [
        'product_id',
        'size',
        'price'
    ];

    public function productStock()
    {
        return $this->hasOne('App\ProductStock', 'product_size_id');
    }
}