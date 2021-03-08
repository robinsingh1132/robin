<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $table = 'product_tags';

    protected $fillable = [
        'product_id',
        'tag_name',
    ];
}