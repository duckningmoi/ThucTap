<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $fillable=[
        'name',
        'slug',
    ];
    public function post(){
        
    }
}
