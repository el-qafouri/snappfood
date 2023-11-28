<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'food_id',
        'message',
        'score',
        'parent_id',
        'is_owner',
        'is_accepted',
        'is_deleted'

    ];
    protected $attributes = [
        'message'=>'',
    ];

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getIsOwnerAttribute() {
        return auth()->check() && auth()->user()->id == $this->user_id;
    }
}
