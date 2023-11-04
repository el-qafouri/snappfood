<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'start_time',
        'end_time',
    ];

    protected $guarded = [
        'id',
        'deleted_at',
        'food_id',
        'restaurant_id',
    ];

}
