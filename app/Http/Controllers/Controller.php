<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

            public function generateCode($tbl, $field = 'code', $prefix = 'T')
{ 
    $month = date('m');
    $year  = date('y'); 
 
    $last = DB::table($tbl)
        ->where($field, 'like', $prefix . $month . $year . '%')
        ->orderBy($field, 'desc')
        ->first();

    if ($last) {
        
        $lastNumber = (int) substr($last->{$field}, -4);
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $nextNumber = '0001';
    }
    $code = $prefix . $month . $year . $nextNumber;

    return $code;
}



}
