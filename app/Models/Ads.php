<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'location',
        'linkUrl',
        'is_active',
    ];
}
