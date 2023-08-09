<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_list(){
        $users = User::all();
        return view('admin.user.user_list',compact('users'));
    }
    public function user_remove($user_id){
        User::find($user_id)->delete();
        return back();
    }
}
