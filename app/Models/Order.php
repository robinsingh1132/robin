<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'price',
        'quantity',
        'total',
        'f_id',
        'user_id'
    ];
    public function food()
    {
        return $this->belongsTo(Food::class, 'f_id', 'id');
    }
}
