<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'static_pages';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'page_content',
        'page_title',
        'meta_keywords',
        'meta_description',
    ];
}
