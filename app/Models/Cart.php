<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'payment_status	',
        'food_id',
        'count',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
