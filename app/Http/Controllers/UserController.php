<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        $this->validate($request, [
            'image' => 'image|nullable|max:2048'
        ]);

        //Handle File Upload
        if($request->hasFile('image'))
        {
            //How to get a  file name with the Extension
            $filenameWihtExt = $request->file('image')->getClientOriginalName();
            //Get just the filename
            $filename  = pathinfo($filenameWihtExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload  the image
            $request->file('image')->storeAs('public/images', $fileNameToStore);
            //php artisan storage:link to link the storage directory into public directory
        }

        $user = User::find($id);

        if($request->hasFile('image'))
        {
            if($user->image != 'female.jpg')
            {
                //Delete the image
                Storage::delete('public/images/'. $user->image);
            }
            $request->session()->forget('image');
            $user->image = $fileNameToStore;
            $user->save();
            Session::put('image', $user->image);

            //success, error, info, warning
            Toastr::success('Image profile has been uploaded successfully :)','Success');
        }
        
        if(auth()->user()->name == request('name') && auth()->user()->username == request('username'))
        {
            return back();            
        }
        elseif(auth()->user()->username == request('username'))
        {
            $request->session()->forget('user');

            $user->name = request('name');
            $user->save();

            Session::put('user', $user->name);

            //success, error, info, warning
            Toastr::success('Your  profile has been updated successfully :)','Success');

            return back();
        }
        else
        {
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
            ]);

            $request->session()->forget('user');
            $request->session()->forget('username');

            $user->name = request('name');
            $user->username = request('username');
            $user->save();

            Session::put('user', $user->name);
            Session::put('username', $user->username);

            //success, error, info, warning
            Toastr::success('Your login credentials has been updated successfully :)','Success');

            return back();
        }

    }

    public function profile($id)
    {
        if(auth()->user()->id == $id)
        {
            $title = "Profile";
            $profile = User::find($id);
            return view('profile', compact('profile', 'title'));
        }
        else
        {
            return redirect('errors.404');
        }
    }

    public function changePassword(Request $request, $id){
        date_default_timezone_set('Asia/Manila');

        if(request('new_password') == request('re_new_password')){

            if(Hash::check($request->input('old_password'), auth()->user()->password))
            {
                $user = User::find($id);
                $user->password = Hash::make(request('new_password'));
                $user->save();

                //success, error, info, warning
                Toastr::success('Change Password successfully :)','Success');

                return back();
            }else{
                //success, error, info, warning
                Toastr::error('Please check your old password :)','Warning');

                return back();

            }
            
        }else{
            //success, error, info, warning
            Toastr::error('New Password did not match :)','Warning');

            return back();
        }
    }
}