<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
      'alt',
        'title',
        'image_path',
        'link',
        'is_active',
    ];
}
