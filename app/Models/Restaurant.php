<?php

namespace App\Models;

use Carbon\Carbon;
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
        'profile_status',
        'open_time',
        'close_time',

    ];
    protected $guarded = [
        'id',
        'user_id',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurantCategories()
    {
        return $this->belongsToMany(RestaurantCategory::class, 'restaurant_restaurant_category', 'restaurant_id', 'restaurant_category_id');
    }

    public function foods()
    {
        return $this->hasMany(Food::class, 'restaurant_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'restaurant_id');
    }



    public static function booted()
    {
        static::retrieved(function ($restaurant) {
            $restaurant->is_open = $restaurant->checkIfOpen();
        });
    }
    public function checkIfOpen()
    {
        $now = Carbon::now();
        $openTime = Carbon::createFromTimeString($this->open_time);
        $closeTime = Carbon::createFromTimeString($this->close_time);

        return $now->between($openTime, $closeTime, true);
    }


}
