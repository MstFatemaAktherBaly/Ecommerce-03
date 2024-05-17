<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryName',
        'slug',
        'icon'


    ];

    function subCategories(){
        return $this->hasMany(Category::class, 'category_id')->with('subCategories');
    }

    function products () {
        return $this->belongsToMany(Product::class);
    }
    
}
