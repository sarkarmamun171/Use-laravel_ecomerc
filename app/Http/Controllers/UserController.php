<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function user_list(){
        return view('admin.user.user_list');
     }
}
