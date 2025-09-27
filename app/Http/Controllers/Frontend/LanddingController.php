<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller; 
class LanddingController extends Controller
{
    public function index(){
        
        return view('frontend.index');
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
