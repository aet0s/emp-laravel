<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
   public function index(){
    return view('admin.auth.login');
   }


   public function customLogin(Request $request)
{
    //dd($request->all());
       $request->validate([
        //'role' => 'required',
        'email' => 'required',
        'password' => 'required|min:6',
        'captcha' => 'required|captcha',
    ], [
        'captcha.captcha' => 'Invalid captcha code.',
        'password.min' => 'The password must be at least 6 characters long.',
    ]
);


    $credentials = $request->only('email', 'password');

    $loginAttemptsKey = 'login_attempts_' . $credentials['email'];
    $maxAttempts = 3; // Maximum number of login attempts
    $lockoutTime = 5; // Lockout time in minutes



    if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard')->withSuccess('Login Successfully');
        
    }

     return redirect("/")->withError('Login details are not valid');
}

    public function signOut()
      {
          Session::flush();
          Auth::logout();   
          return redirect('/')->withError('Logout Successfully');
      }



   public function dashboard(){
    return view('admin.dashboard');
   }

   public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }






}
