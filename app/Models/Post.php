<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'content',
        'slug',
        'location',
        'is_approved',
        'viewer',
        'user_id',
        'category_id'
    ];
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
