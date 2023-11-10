<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = [
        'discount',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function foods(){
        return $this->hasMany(Food::class , 'discount_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }






}
