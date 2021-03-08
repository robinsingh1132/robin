<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopRankedProducts extends Model
{
    protected $table = 'top_ranked_products';
    protected $fillable = [
        'product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}