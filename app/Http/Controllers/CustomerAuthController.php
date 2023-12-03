<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function customer_login(){
        return view('frontend.customer.login');
    }
    public function customer_register(){
        return view('frontend.customer.register');
    }

    public function customer_store(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'password'=> Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),
            'password_confirmation'=>'required',

        ]);
        Customer::insert([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('register','Registration Successfully');
    }

    public function customer_login_confirm(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if (Customer::where('email',$request->email)->exists()) {
                if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('index');
                }
                else{
                    return back()->with('exist','Wrong Password');
                }
            }
        else
        {
           return back()->with('exist','Email Dose Not Exist');
        }

    }

}

