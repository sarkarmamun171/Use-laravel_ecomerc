<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
   public function product(){
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $brands=Brand::all();
    return view('admin.product.index',[
        'categories'=>$categories,
        'subcategories'=>$subcategories,
        'brands'=> $brands,
    ]);
   }
   public function getsubcategory(Request $request){
    $str ='<option value=""> Select Subcategory</option>';
     $subcategories = Subcategory::where('category_id',$request->category_id)->get();
     foreach ($subcategories as  $subcategory) {
       $str.='<option value="'.$subcategory->id.'">'.$subcategory->Subcategory_name.'</option>';
     }
     echo $str;
   }
   public function product_store(ProductRequest $request){

    $after_implode = implode(',',$request->tags);

    $pre_image = $request->pre_image;
    $extension =  $pre_image->extension();
    $filename = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . random_int(10, 200) . '.' . $extension;
    $image = Image::make($pre_image)->resize(300, 200)->save(public_path('uploads/product/preview/' . $filename));

    Product::insert([
        'category_id'=>$request->category,
        'subcategory_id'=>$request->subcategory,
        'brand_id'=>$request->brand,
        'product_name'=>$request->product_name,
        'price'=>$request->price,
        'discount'=>$request->discount,
        'after_discounter'=>$request->price-($request->price*$request->discount/100),
        'tags'=>$after_implode,
        'short_des'=>$request->short_des,
        'long_description'=>$request->long_description,
        'add_info'=>$request->add_info,
        'pre_image'=>$filename,
        'slug'=>Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . random_int(100, 2000000),
        'created_at'=>Carbon::now(),
    ]);
    return back()->with('success','Product Added Successfully');
   }
}
