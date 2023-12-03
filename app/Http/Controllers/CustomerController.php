<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller

{
    public function customer_profile()
    {
        return view('frontend.customer.profile');
    }

    public function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function customer_profile_update(Request $request)
    {
        // $request->validate([
        //     'fname' => 'required|required',
        //     'lname'=>'required|required',
        //     'email'=>'required'
        //   ]);
        if ($request->password == '') {
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
                    'City'=>$request->City,
                    'address'=>$request->address,
                    'zip'=>$request->zip
                ]);
            } else {
                if (Auth::guard('customer')->user()->photo !=null) {
                    $delete_photo = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                    unlink( $delete_photo);
                }
                $image = $request->photo;
                $extension = $image->extension();
                $file_name = Auth::guard('customer')->id().'.'.$extension;
                Image::make($image)->save(public_path('uploads/customer/'.$file_name));

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
                    'City'=>$request->City,
                    'address'=>$request->address,
                    'zip'=>$request->zip,
                    'photo'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
            }
        } else {
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'password'=>bcrypt($request->password),
                    'country'=>$request->country,
                    'phone'=>$request->phone,
                    'City'=>$request->City,
                    'address'=>$request->address,
                    'zip'=>$request->zip
                ]);
            } else {
                if (Auth::guard('customer')->user()->photo !=null) {
                    $delete_photo = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                    unlink( $delete_photo);
                }

                $image = $request->photo;
                $extension = $image->extension();
                $file_name = Auth::guard('customer')->id().'.'.$extension;
                Image::make($image)->save(public_path('uploads/customer/'.$file_name));
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'password'=>bcrypt($request->password),
                    'country'=>$request->country,
                    'phone'=>$request->phone,
                    'City'=>$request->City,
                    'address'=>$request->address,
                    'zip'=>$request->zip,
                    'photo'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
            }
        }

        return back();
    }

}
