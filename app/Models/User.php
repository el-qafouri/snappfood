<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];


    public function restaurantCategories()
    {
        return $this->belongsToMany(RestaurantCategory::class, 'user_restaurant_category', 'user_id', 'restaurant_category_id');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }


    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }


    public function foods()
    {
        return $this->hasMany(Food::class);
//        return $this->hasMany(Food::class, 'user_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

}
