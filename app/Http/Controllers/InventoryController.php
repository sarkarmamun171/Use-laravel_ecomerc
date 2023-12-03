<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function variation(){
        $colors = Color::all();
        $categories = Category::all();

        return view('admin.product.variation',[
            'colors'=>$colors,
            'categories'=>$categories,

        ]);
    }
    public function color_store(Request $request){
        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            //'size_name'=>$request->size_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('color','Color Added Successfully');
    }
    public function size_store(Request $request){
        Size::insert([
            'size_name'=>$request->size_name,
            'category_id'=>$request->category_id,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('size','Size Added Successfully');
    }
    public function color_remove($id){
        Color::find($id)->delete();
        return back();
    }

    public function size_remove($id){
        Size::find($id)->delete();
        return back();
    }
    public function inventory($id){
       $products= Product::find($id);
       $colors = Color::all();
       $inventory= Inventory::where('product_id',$id)->get();
        return view('admin.product.inventory',[
            'products'=>$products,
            'colors'=>$colors,
            'inventory'=>$inventory,
        ]);
    }
    public function inventory_store(Request $request, $id){
      Inventory::insert([
        'product_id'=>$id,
        'color_id'=>$request->color_id,
        'size_id'=>$request->size_id,
        'quantity'=>$request->quantity,
        'created_at'=>Carbon::now(),
      ]);
      return back()->with('success','Inventory Added Successfully');
    }
}
