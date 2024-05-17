<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "feutured_img",
        "price",
        "selling_price",
        "sku",
        "brand",
        "stock",
        "status",
        "featured",
        "short_detail",
        "long_text",
        "cross_sell", 
    ];

function gallaries(){
    return $this->hasMany(Gallery::class);
}

function categories () {
    return $this->belongsToMany(Category::class);
}

function reviews(){
    return $this->hasMany(Review::class);
}

}
