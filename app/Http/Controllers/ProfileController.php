<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.users.profile')->with('user', Auth::user());
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required',
            // 'avatar' => 'required|image',
            'email' => 'required|email',
            'facebook' => 'required|url',
            'youtube' => 'required|url'
        ]);

        $user = Auth::user();
        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;

            $avatar_new_name = time().$avatar->getClientOriginalName();
            
            Storage::disk('public')->put($avatar_new_name, file_get_contents($avatar));

            $user->profile->avatar = $avatar_new_name;

            // $user->profile->avatar = 'storage/'.$avatar_new_name;
            // $user->profile->avatar = asset('storage/'.$avatar_new_name);

            $user->profile->save();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->about = $request->about;
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;

        $user->save();

        $user->profile->save();

        if($request->has('password')){

            $user->password = bcrypt($request->password);
            
            $user->save();
        }

        Session::flash('success', 'Account profile updated successfully');

        return redirect()->back();
    }
}
