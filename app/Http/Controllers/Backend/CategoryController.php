<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\MediaUploader;
use App\Helpers\SlugGenerator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{



    function category(){
        $categories  = Category::with('subCategories')->latest()->paginate(30);

        $perentCategories = $categories->where('category_id', null)->flatten();

        // dd($categories);
        
         return view('backend.category' , compact('categories', 'perentCategories'));
      
    }
 
    use SlugGenerator,MediaUploader;
    

    function categoryInsert(Request $request){
        
      $request->validate([
        'icon' => "mimes:png,jpg"
      ]);

     
          $slug = $this->createSlug(Category::class, $request->category);
          if($request->hasFile('icon')){
            $iconPath = $this->uploadSingleMedia($request->icon,$slug,'category');
          }
          
          $category = new Category();
          $category->categoryName= $request->category;
          $category->category_id= $request->category_id;
          $category->slug = $slug;
          $category->icon = $request->hasFile('icon') ? $iconPath : null;
          $category ->save();
          return back();
    }

    //edit

    function categoryEdit($id){
      $categories  = Category::with('subCategories')->latest()->paginate(30);

      $perentCategories = $categories->where('category_id', null)->flatten();

      $findCategory= $categories->where('id', $id)->first();

      // dd($findCategory);
      return view('backend.category',compact('categories','findCategory','perentCategories')) ;
    }


    //update

    function categoryUpdate(Request $request,$id){
      $slug = $this->createSlug(Category::class, $request->category);
      if($request->hasFile('icon')){
        $iconPath = $this->uploadSingleMedia($request->icon, $slug, 'category',  $request->old);
      }
      
      $category = Category::find($id);
      $category->categoryName= $request->category;
      $category->category_id= $request->category_id;
      $category->slug = $slug;
      $category->icon = $request->hasFile('icon') ? $iconPath : null;
      $category ->save();
      return back();
        //  dd($updateCategory);
    }

    //delete

    function categoryDelete($id){
       Category::find($id)->delete();
       return back();
    
  
    }
}
