<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

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

    public function user_image_update(Request $request){
        $request->validate([
            'photo'=>'required|mimes:jpg,png,svg,jpeg,pjp,webp',
            'photo'=>'file|max:300',
            'photo'=>'dimensions:width=100,height=200'
        ]);
//image tag use korar jojo {{Intervention Image}} lakbe
        if (Auth::user()->photo==null) {
            $photo = $request->image;
            $extension = $photo->extension();
            $filename = Auth::id().'.'.$extension;
            //echo $filename;
            $image = Image::make($photo)->resize(300, 200)->save(public_path('uploads/users/'.$filename));

            User::find(Auth::id())->update([
                'photo'=>$filename,
            ]);
        }
        else{
            $pre_photo =public_path('uploads/users/'.Auth::user()->photo);
            unlink($pre_photo);

            $photo = $request->image;
            $extension = $photo->extension();
            $filename = Auth::id().'.'.$extension;
            //echo $filename;
            $image = Image::make($photo)->resize(300, 200)->save(public_path('uploads/users/'.$filename));

            User::find(Auth::id())->update([
                'photo'=>$filename,
            ]);
            return back()->with('image_update','Profile Image Update Succeessful');
            }
        }
     }

?>
