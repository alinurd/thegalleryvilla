<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(){
        if(auth()->check()){
            $user = User::find(auth()->id());
            if($user && $user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
        }

        return view('admin.auth.login');
    }


    public function postLogin(Request $request){
        $credentials = $this->validate(request(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::validate($credentials)){
            $email = trim(strtolower($request->email));
            $user = User::where('email', $email);
            $userRow = $user->first();
            if($userRow->hasRole('admin') && $userRow->status == 1) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->route('admin.dashboard');
                }
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function postLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.view');
    }

}
