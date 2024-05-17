<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function showCategoryProduct($slug)
    {
     
        $category = Category::select('id' , 'categoryName')->where('slug' , $slug)->first();

       $products = Product::with(['gallaries' => function($query){
        return $query->select('id','product_id','title')->first();
       }])
       ->whereHas('categories' , function($q) use($slug){
        return $q->where('slug', $slug);
       })
       ->where('status' , true)
       ->select('id','title','slug','feutured_img','price' ,'selling_price','status')
       ->get();
    //    dd($products);

    return view('frontend.categoryArchieve' ,compact('products' ,'category'));
    }


    function showProduct($slug){
        $product = Product::with(['gallaries', 'reviews.user'])->where('slug', $slug)->first();
        // dd($product->reviews);
      return view('frontend.single-product' ,compact('product'));
    }

    function searchProduct (REQUEST $request){
      $search = $request->search;
      $products = Product::where('title', 'LIKE' , '%' . $search . '%')->take(2)->get();
      $count = Product::where('title', 'LIKE' , '%' . $search . '%')->count();
      return response()->json([
        'products' => $products , 
        'count' => $count]);
    }
}


