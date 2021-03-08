<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiStatus extends Model
{
    protected $table = 'api_status';
    protected $fillable = [
        'status'
    ];
}
