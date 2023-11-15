<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = [
        'discount',
        'user_id',
        'restaurant_id',
        'food_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class, 'discount_id');
    }

//    public function restaurant()
//    {
//        return $this->belongsTo(Restaurant::class , 'discount_id');
//    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


//    public function scopeForRestaurant($query)
//    {
//        return $query->where('restaurant_id', auth()->user()->restaurant->id);
//    }



}
