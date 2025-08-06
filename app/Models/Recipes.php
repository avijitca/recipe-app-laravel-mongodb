<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

// use Illuminate\Database\Eloquent\Model;

class Recipes extends Model{
    protected $connection = 'mongodb'; 
    protected $collection = 'allrecipe';
    protected $fillable = [
    'title', 'description', 'ingredients', 'steps', 'cooking_time', 'created_at'
    ];


}
