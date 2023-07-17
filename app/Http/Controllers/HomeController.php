<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }
    public function user_profile(){
        return view('admin.user.user');
    }
    public function user_profile_update(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns'
        ]);

         $user = User::find(Auth::id())->update([
            'name' =>$request->name,
            'email' =>$request->email,
        ]);
        return back();
        
    }
    public function user_password_update(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password'=> Password::min(8)
                 ->letters()
                 ->mixedCase()
                 ->numbers()
                 ->symbols(),
            'password_confirmation'=>'required'
        ]);

        $user= User::find(Auth::id());
        if (password_verify($request->old_password,$user->password)) {
           User::find(Auth::id())->update([
            'password'=>bcrypt($request->password),
           ]);
           return back()->with('password_update','Password Update Succeessful');
        }
        else {
            return back()->with('current_pass','Wrong old Password');
        }
       
    }
}

?>