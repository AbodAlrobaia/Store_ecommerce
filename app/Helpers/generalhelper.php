<?php

use Illuminate\Support\Facades\App;


define('PAGINATION_COUNT',15);
function getfolder()
 {

    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';

}


// ذه الفانكشن بتاخذ المللف الذي بنخزن فيه والصوره تفسهات  التي بنخزنها
function uploadImage ($folder, $image){
     $image->store('/' ,$folder); //  ميثود عملتها لارفل store
     // الصوره هذه التي حائت باراميتر  خزنها داخل المجلد هذا الذي هو داخل الاستور
     $filename =$image->hashName();
    //  $path='images/' .$folder. '/'.$filename;
      return $filename;

}
