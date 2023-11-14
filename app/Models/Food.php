<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'price',
        'material',
        'food_category_id',
        'restaurant_id',
        'discount_id',
        'user_id'
    ];

    protected $guarded = [
        'id',
        'deleted_at',
    ];

    protected $visible = ['discounted_price', 'final_price' , 'price', 'count', 'pivot_count'];

    protected $attributes = [
        'final_price' => 0,
    ];

    public function foodCategories()
    {
        return $this->belongsTo('foodCategories', 'food_category_id', 'id');
    }

//    public function foodCategory()
//    {
//        return $this->belongsTo(FoodCategory::class, 'food_category_id');
//    }



    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function foodCategory()
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('count');
    }

//    public function comments()
//    {
//        return $this->hasMany(Comment::class);
//    }


    public function discount()
    {
        return $this->belongsTo(Discount::class , 'discount_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
