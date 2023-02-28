<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        return $credentials;
    }
    
    public function username()
    {
        return 'username';
    }

    function authenticated(Request $request, $user)
    {
        date_default_timezone_set('Asia/Manila');

        $request->validate([
            'username'    => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['username'=> $username,'password'=> $password])) 
        {
            $user = Auth::User();
            Session::put('user_id', $user->id);
            Session::put('user', $user->name);
            Session::put('username', $user->username);
            Session::put('image', $user->image);

            //Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
            Toastr::success('Login successfully :)','Success');
        }
        else 
        {
            //Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
            Toastr::error('fail, WRONG USERNAME OR PASSWORD :)','Error');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        // forget login session
        $request->session()->forget('user_id');
        $request->session()->forget('user');
        $request->session()->forget('username');
        $request->session()->forget('image');
        $request->session()->flush();

        auth()->guard()->logout();
        //Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        Toastr::success('Logout successfully :)','Success');
        return redirect('/login');
    }    
}