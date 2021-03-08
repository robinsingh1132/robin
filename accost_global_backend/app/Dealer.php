<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $table = 'dealers';
    protected $fillable = [
       'first_name', 'last_name', 'contact_number', 'email', 'address'
    ];
}
