<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Master\Banner;

class LanddingController extends Controller
{
    public function index(){
        $data['banner']=Banner::where('status',1)->get();
        return view('frontend.index', $data);
    }

    public function about(){
        
        return view('frontend.pages.about.index');
    }
    public function facility(){
        
        return view('frontend.pages.facility.index');
    }
    public function gallery(){
        
        return view('frontend.pages.gallery.index');
    }
    public function booking(){
        
        return view('frontend.pages.booking.index');
    }
    public function contact(){
        
        return view('frontend.pages.contact.index');
    }

 
}
