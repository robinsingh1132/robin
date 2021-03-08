<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHighlight extends Model
{
    protected $table = 'product_highlights';
    protected $fillable = [
        'product_id',
        'highlight_id',
        'highlight_name',
        'highlight_value',
    ];
}