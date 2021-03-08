<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'tax_product_type';
    protected $fillable = [
        'type', 'default_tax'
    ];
    /*public function tax()
    {
        return $this->hasOne('App\Tax','tax_product_type_id');
    }*/
}