<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class BrandController extends Controller
{
    public function category_brand()
    {
        $brands = Brand::Paginate(6);
        return view('admin.brand.brand', [
            'brands' => $brands,
        ]);
    }
    public function category_brand_store(Request $request)
    {

        $request->validate([
            'brand_name' => 'required',
            'brand_logo' => 'required|image',
        ]);

        $img = $request->brand_logo;
        $extension =  $img->extension();
        $filename = Str::lower(str_replace(' ', '-', $request->brand_name)) . '-' . random_int(10, 200) . '.' . $extension;
        $image = Image::make($img)->save(public_path('uploads/brands/' . $filename));


        Brand::Insert([
            'brand_name' => $request->brand_name,
            'brand_logo' => $filename,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Brand Added Successfully');
    }
    public function category_brand_edit($id)
    {
        $brand_information = Brand::find($id);
        return view('admin.brand.edit', [
            'brand_information' => $brand_information,
        ]);
    }
    public function category_brand_update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $request->validate([
            'brand_name' => 'required',
        ]);
        if ($request->brand_logo == '') {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);
        } else {
            $request->validate([
                'brand_logo' => 'required',
            ]);

            $current_img = public_path('uploads/brands/' . $brand->brand_logo);
            unlink($current_img);

            $img = $request->brand_logo;
            $extension = $img->extension();
            $filename = Str::lower(str_replace(' ', '-', $request->brand_name)) . '-' . random_int(10, 200) . '.' . $extension;
            Image::make($img)->save(public_path('uploads/brands/' . $filename));

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_logo' => $filename,
            ]);
            return back()->with('success', 'Brand Added Successfully');
        }
    }
    public function category_brand_delete($id)
    {
        $brand = Brand::find($id);
        $current_img = public_path('uploads/brands/' . $brand->brand_logo);
        unlink($current_img);

        $brand->delete();
        return back()->with('delete', 'Brand Deleted Successfully');
    }
}
