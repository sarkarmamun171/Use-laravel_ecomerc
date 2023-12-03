<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function customer_cart_store(Request $request){
        $request->validate([
            'color_id' =>'required',
            'size_id'  =>'required'
        ]);

        Cart::insert([
            'customer_id'   =>Auth::guard('customer')->id(),
            'product_id'    =>$request->product_id,
            'color_id'      =>$request->color_id,
            'size_id'       =>$request->size_id,
            'quantity'      =>$request->quantity,
            'created_at'    =>Carbon::now()
        ]);
         return back()->with('cart_add','Cart Added Successfully');
    }
   // return back()->with('cart_add','Cart Added Successfully');
}
