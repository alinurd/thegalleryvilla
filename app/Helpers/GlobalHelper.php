<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

function isActiveRoute($routes, $output = 'active') {
    if (!is_array($routes)) {
        $routes = [$routes];
    }

    foreach ($routes as $route) {
        if (Route::is($route)) {
            return $output;
        }
    }

    return '';
}

function isActiveOpen($routes, $output = 'active open') {
    if (!is_array($routes)) {
        $routes = [$routes];
    }

    foreach ($routes as $route) {
        if (Route::is($route)) {
            return $output;
        }
    }

    return '';
}
function fileUpload($file,$location,$fileBefore = false){
    $filename =  Str::uuid().'.'.$file->getClientOriginalExtension();
    if ($fileBefore) {
        Storage::disk('public')->delete($location.$fileBefore);
    }
    Storage::disk('public')->putFileAs($location,$file,$filename);
    return $filename;
}
function fileDelete($fileBefore,$location){
    Storage::disk('public')->delete($location.$fileBefore);
    return 1;
}

function responseOk($data = null){
    if ($data) {
        return response()->json(['code' => 200,'message' => 'OK','data' =>$data], 200);
    }
    else
    return response()->json(['code' => 200,'message' => 'OK'], 200);
}

function responseBadRequest($data){
    return response()->json(['code' => 400,'message' => 'BAD_REQUEST','errors' => $data], 400);
}

function responseInternalServerError($data = 'INTERNAL_SERVER_ERROR'){
    return response()->json(['code' => 500,'message' => $data], 500);
}

function responseNotFound(){
    return response()->json(['code' => 404,'message' => 'NOT_FOUND'], 404);
}

function responseForbidden(){
    return response()->json(['code' => 403,'message' => 'FORBIDDEN'], 403);
}

function phoneIndo($nohp){
    // kadang ada penulisan no hp 0811 239 345
     $nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
     $nohp = str_replace(".","",$nohp);

      // cek apakah no hp mengandung karakter + dan 0-9
      if(!preg_match('/[^+0-9]/',trim($nohp))){
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($nohp), 0, 3)=='+62'){
            return $hp = trim($nohp);
        }
        elseif(substr(trim($nohp), 0, 2)=='62'){
            return $hp = '+'.trim($nohp);
        }
        elseif(substr(trim($nohp), 0, 1)=='8'){
            return $hp = '+62'.trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($nohp), 0, 1)=='0'){
           return $hp = '+62'.substr(trim($nohp), 1);
        }

    }
}
