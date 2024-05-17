<?php

namespace  App\Helpers;

trait SlugGenerator{

    function createSlug($class, $title){
        $slug =  str()->slug($title);
        $count = $class::where('slug', 'LIKE', '%'. $slug .'%')->count();
        // dd($count);
     

        if ($count > 0){
          $count++;
          $slug =  $slug . '-'. $count ;
        }

        return $slug;
    }
}