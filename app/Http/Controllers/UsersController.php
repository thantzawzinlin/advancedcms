<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users= User::all();
        return view('admin.users.index')->with('users',$users);
    }
    public function make_admin(User $user){
        $user->role='admin';
        $user->save();
        toastr()->success('You had changed user permission successfully!');
       return redirect()->route('user.index');
    }
}
