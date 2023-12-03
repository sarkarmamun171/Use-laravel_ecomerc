<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories =Category::all();
        $products   = Product::where('status',1)->latest()->get();

        return view('frontend.index',[
            'categories'  =>$categories,
            'products'    => $products
        ]);
    }
    public function category_products($id){
        $category_products  = Product::where('category_id',$id)->get();
        $categories         = Category::find($id);
        return view('frontend.category_product',[
            'category_products'  =>$category_products,
            'categories'         =>$categories,
        ]);
    }

    public function subcategory_products($id){
        $subcategory_products= Product::where('subcategory_id',$id)->get();
        $subcategories = Subcategory::find($id);
        return view('frontend.subcategory_product',[
            'subcategory_products' =>$subcategory_products,
            'subcategories'        =>$subcategories,
        ]);
    }
    public function product_details($slug){
            $product_id        = Product::where('slug',$slug)->first()->id;
            $product_details   = Product::find($product_id);
            $ava_colors        = Inventory::where('product_id',$product_id)
            ->groupBy('color_id')
            ->selectRaw('count(*) as total,color_id')->get();
            $ava_sizes         = Inventory::where('product_id',$product_id)
            ->groupBy('size_id')
            ->selectRaw('count(*) as total,size_id')->get();

             return view('frontend.product_details',[
            'product_details'   => $product_details,
            'ava_colors'        => $ava_colors,
            'ava_sizes'         => $ava_sizes,
        ]);
    }
    public function getSize(Request $request){
        $str ='' ;
        $sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        foreach ($sizes as $size) {
            $str.='<li class=""><input id="size'.$size->size_id.'" type="radio" class="size_id"
            name="size" value="'.$size->size_id.'"><label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label></li>';
        }
        echo $str;
    }

    public function getQuantity(Request $request){
        $str ='';
        $quantity =  Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;
        if ($quantity == 0) {
            $quantity ='<button class="btn btn-danger">Out of Stock</button>';
        }
        else {
            $quantity ='<button class="btn btn-success">'.$quantity.' in Stock</button>';
        }
        echo $quantity;
    }

}
