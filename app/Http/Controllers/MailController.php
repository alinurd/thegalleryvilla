<?php

namespace App\Http\Controllers;

use App\Mail\gmailMail;
use App\Models\AppSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function index(Request $request){


     $details = [
      'email' => $request->email,
      'name' => $request->name,
      'subject' => $request->subject,
      'title' => 'Info The Gallery Villa',
      'body' => $request->message,

    ];


     $adminEmail = AppSetting::select('email')->first();
     \Mail::to($adminEmail['email'])->send(new gmailMail($details));
                return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);

                 
    }
}

