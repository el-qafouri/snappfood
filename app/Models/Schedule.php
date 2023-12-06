<?php

namespace App\Models;

use App\Enums\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'day',
        'open_time',
        'close_time',
    ];

//    protected $dates = ['open_time', 'close_time'];

    protected $casts = [
        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',
    ];

//    protected $casts = [
//        'day' => 'enum:Day',
//    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

//    public function getDayAttribute($value)
//    {
//        return Day::from($value);
//    }
//
//    public function setDayAttribute($value)
//    {
//        $this->attributes['day'] = $value;
//    }


}
