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
        'food_category_id'
    ];

    protected $guarded = [
        'id',
        'deleted_at',
    ];


    public function foodCategories() {
        return $this->belongsTo('foodCategories', 'food_category_id' , 'id');
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
