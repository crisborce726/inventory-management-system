<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Lockscreen extends Controller
{
    public function locked()
    {
        Session::put('locked', true);

        return view('auth.locked');
    }
    
    public function unlock(Request $request)
    {
        if ($request->session()->has('locked')) {
            
            $check = Hash::check($request->input('password'), auth()->user()->password);

            if (!$check) 
            {
                Toastr::error('Your password does not match your Credential :)','Error');
                return redirect()->route('login.locked');
            }

            // forget login session
            $request->session()->forget('locked');

            Toastr::success('You have successfully retrieve your session:)','Success');
            
            return redirect('/home');
        }
        
    }
}