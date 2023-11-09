<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_name',
        'phone',
        'send_cost',
        'address',
        'credit_card_number',
        'restaurant_category_id',

    ];
    protected $guarded = [
        'id',
        'user_id',
        'deleted_at',
    ];

//    public function restaurantCategories()
//    {
//        return $this->belongsTo('restaurantCategories', 'restaurant_category_id', 'id');
//    }


    public function restaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class, 'restaurant_category_id');
    }

    public function food()
    {
        return $this->hasMany(Food::class);
    }

}
