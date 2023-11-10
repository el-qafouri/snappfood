<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'material',
        'food_category_id',
        'restaurant_id',
        'discount_id'
    ];

    protected $guarded = [
        'id',
        'deleted_at',
    ];

    protected $visible = ['discounted_price', 'price', 'count', 'pivot_count'];


    public function foodCategories()
    {
        return $this->belongsTo('foodCategories', 'food_category_id', 'id');
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
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



}
