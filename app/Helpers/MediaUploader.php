<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

trait MediaUploader{

    function uploadSingleMedia($file,$fileName,$dirName,$old = null, $accessibility = 'public'){


        if($file){

            if($old){
             Storage::disk($accessibility)->delete($old);
            }
            $filename = "$fileName." . $file->getClientOriginalextension();
            $mediaPath = $file->storeAs( $dirName,$filename, $accessibility);
  
            return $mediaPath;
        }
    
     
    }
    
    

    function uploadMultiplMedia($files , $dirName, $accessibility = 'public' ) {

        if($files) {

            $mediaPathArray = [];
        
            foreach ($files as  $file ) {

               if($file){
                $fileName = uniqid() . '.' . $file->getClientOriginalextension();
                $mediaPath = $file->storeAs($dirName, $fileName, $accessibility);
                $mediaPathArray[] = $mediaPath ;
               }
           }
           return $mediaPathArray;
}
}
}