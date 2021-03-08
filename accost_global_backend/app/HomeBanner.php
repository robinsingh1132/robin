<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    protected $table = 'home_banners';
    protected $fillable = [
        'name',
        'image_link',
        'mobile_image_link',
        'image_alt',
        'position',
        'url',
        'status'
    ];
}