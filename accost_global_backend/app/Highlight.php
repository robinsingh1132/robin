<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $table = 'highlights';
    protected $fillable = [
       'name'
    ];
    public function highlightSubcategories()
    {
        return $this->hasMany('App\HighlightsSubCategory');
    }
}