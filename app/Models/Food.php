<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;


    protected $table = 'foods';

    public function getTable()
    {
        return 'foods';
    }


    protected $fillable = [
        'name',
        'price',
        'material',
        'restaurant_id',
        'final_price',
        'user_id',
        'image_path',
    ];

    protected $guarded = [
        'id',
        'deleted_at',
    ];

    protected $visible = ['discounted_price', 'final_price', 'price', 'count', 'pivot_count'];

    protected $attributes = [
        'final_price' => 0,
    ];

//    public function foodCategories()
//    {
//        return $this->belongsTo('foodCategories', 'food_category_id', 'id');
//    }

    public function foodCategories()
    {
        return $this->belongsToMany(FoodCategory::class, 'food_food_category');
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

//    public function foodCategory()
//    {
//        return $this->belongsTo(FoodCategory::class);
//    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('count');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
