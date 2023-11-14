<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $guarded = [
        'id',
        'deleted_at',
    ];

    public function restaurant()
    {
        $this->hasMany('restaurant', 'restaurant_category_id', 'id');
    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'user_restaurant_category', 'restaurant_category_id', 'user_id');
    }


    public function category()
    {
        return $this->belongsTo(RestaurantCategory::class, 'restaurant_category_id');
    }

}
