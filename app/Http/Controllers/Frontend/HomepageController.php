<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    function homepage(){
        $categories = Category::latest()->take(10)->get();
       
        return view('frontend.homePage', compact('categories'));
    }
}
