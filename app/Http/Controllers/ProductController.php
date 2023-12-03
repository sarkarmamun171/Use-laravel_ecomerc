<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function product()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }
    public function getsubcategory(Request $request)
    {
        $str = '<option value=""> Select Subcategory</option>';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach ($subcategories as  $subcategory) {
            $str .= '<option value="' . $subcategory->id . '">' . $subcategory->Subcategory_name . '</option>';
        }
        echo $str;
    }
    public function product_store(Request $request)
    {

        $after_implode = implode(',', $request->tags);

        $pre_image = $request->pre_image;
        $extension =  $pre_image->extension();
        $filename = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . random_int(10, 200) . '.' . $extension;
        $image = Image::make($pre_image)->resize(300, 200)->save(public_path('uploads/product/preview/' . $filename));

        $product_id = Product::insertGetId([
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id' => $request->brand,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discounter' => $request->price - ($request->price * $request->discount / 100),
            'tags' => $after_implode,
            'short_des' => $request->short_des,
            'long_description' => $request->long_description,
            'add_info' => $request->add_info,
            'pre_image' => $filename,
            'slug' => Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . random_int(100, 2000000),
            'created_at' => Carbon::now(),
        ]);

        $gallery = $request->gallery;
        foreach ($gallery as $gal) {
            $extension =  $gal->extension();
            $filename = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . random_int(10, 200) . '.' . $extension;
            $image = Image::make($gal)->save(public_path('uploads/product/gallery/' . $filename));

            ProductGallery::insert([
                'product_id' => $product_id,
                'gallery' => $filename,
            ]);
        }

        return back()->with('success', 'Product Added Successfully');
    }
    public function product_list()
    {
        $products = Product::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_list', [
            'products' => $products,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }
    public function product_delete($id)
    {
        $product = Product::find($id);
        $gallery = ProductGallery::where('product_id', $id)->get();

        $pre_image = public_path('uploads/product/preview/' . $product->pre_image);
        unlink($pre_image);

        foreach ($gallery as $gal) {
            $gallery_image = public_path('uploads/product/gallery/' . $gal->gallery);
            unlink($gallery_image);
            ProductGallery::find($gal->id)->delete();
        }
        Product::find($id)->delete();

            $inventories = Inventory::where('product_id',$id)->get();
            foreach ($inventories as $inventory) {
                Inventory::find($inventory->id)->delete();
            }


        return back();
    }
    public function product_show($id)
    {
        $product = Product::find($id);
        $galleries = ProductGallery::where('product_id',$id)->get();
        return view('admin.product.show', [
            'product' => $product,
            'galleries'=>$galleries,
        ]);
    }
    public function changeStatus(Request $request){
        Product::find($request->product_id)->update([
            'status' => $request->status,
        ]);
    }
}
