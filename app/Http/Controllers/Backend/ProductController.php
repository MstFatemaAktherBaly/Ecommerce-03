<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\MediaUploader;
use App\Helpers\SlugGenerator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;

class ProductController extends Controller
{
    use MediaUploader ,SlugGenerator;

    function addProduct(){

        $categories = Category::select('id' ,'categoryName')->latest()->get();
        return view('products.addProduct' , compact( 'categories'));
    }

    //product Validation

    function storeProduct(Request $request ,$id = null){
       
        $request->validate([
            // 'title'=> 'required',
            // 'price' => 'required|numeric',
            // 'selling_price' => 'required_with:anotherfield|numeric',
            // 'sku' => 'required',
            // 'brand_name' => 'required',
            'gallaries.*' => 'mimes:png,jpg',
        ]); 
       
        

        // dd($this->uploadMultiplMedia($request->gallaries, 'product_img'));

        //Store Or Update new Product

       $product = Product::findOrNew($id);
       

       if($request->hasFile('feutured_img')){
        $feutured_img = $this->uploadSingleMedia($request->feutured_img, $this->createSlug(Product::class, $request->title), 'product' , $product->feutured_img);
    }
    
        $product->title = $request->title;
        $product->slug = $this->createSlug(Product::class, $request->title);
        $product->price = $request->price;
        $product->selling_price = $request->selling_price 	;
        $product->sku = $request->sku;
        $product->brand = $request->brand;
        $product->feutured_img =$feutured_img ?? $product->feutured_img;
        $product->stock = $request->stock;
        $product->short_detail = $request->short_detail;
        $product->long_text = $request->long_text;
        $product->status = $request->status ?? 0;
        $product->featured = $request->featured ?? 0;
        $product->save();

        if ($product){
            $product->categories()->sync($request->categories);
        }
        
        
        
        // $product->feutured_img = $request->feutured_img;
        // $product->cross_sell = $request->cross_sell;

        //Product Gallary

       if($request->gallaries){
        if(count($request->gallaries) > 0){
           $gallaries = $this->uploadMultiplMedia($request->gallaries, 'gallaries');
            foreach($gallaries as $singleGallaryImage){
            $gallery = new Gallery();
            $gallery->title = $singleGallaryImage;
            $gallery->product_id = $product->id;
            $gallery->save();
        }
        }

       }
      


        return back()->with( 'success_msg','Product has been added successfully!');

    }
}
