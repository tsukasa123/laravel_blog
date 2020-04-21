<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        $this->validate($requet, [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => asset('storage/sample.JPG'),
            'about' => 'hey hey hey hey hey hey',
            'facebook' => 'https://www.facebook.com/sample',
            'youtube' => 'https://www.youtube.com/sample'
        ]);

        Session::flash('success', 'User added successfully');
        return redirect()->route('users');
    }

    public function destroy(User $user){
        $user->profile->delete();
        $user->delete();

        Session::flash('success', 'User deleted successfully');
        return redirect()->back();
    }

    public function admin($id){

        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');
        return redirect()->back();
    }

    public function not_admin($id){

        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');
        return redirect()->back();
    }

}
