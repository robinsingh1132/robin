<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender','contact_number',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}