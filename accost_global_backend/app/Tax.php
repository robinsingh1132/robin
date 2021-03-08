<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';
    protected $fillable = [
        'country_id', 'state_id', 'tax', 'tax_product_type_id'
    ];
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function product_type()
    {
        return $this->belongsTo('App\ProductType','tax_product_type_id');
    }
}