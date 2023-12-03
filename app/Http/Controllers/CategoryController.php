<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function Category()
    {
        $categories = Category::Paginate(10);
        return view('admin.category.category', [
            'categories' => $categories,
        ]);
    }
    public function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_image' => 'required|mimes:jpg,png,svg,jpeg,pjp,webp',
            //'category_image'=>'image',
            'photo' => 'file|max:512',
            'photo' => 'dimensions:width=100,height=200'

        ]);
        $img = $request->category_image;
        $extension =  $img->extension();
        $filename = Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . random_int(10, 200) . '.' . $extension;
        $image = Image::make($img)->resize(300, 200)->save(public_path('uploads/category/' . $filename));


        Category::Insert([
            'category_name' => $request->category_name,
            'category_image' => $filename,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category Added Successfully');
    }
    public function category_edit($category_id)
    {
        $category_information = Category::find($category_id);
        return view('admin.category.edit', [
            'category_information' => $category_information,
        ]);
    }

    public function category_update(Request $request)
    {
        $category = Category::find($request->category_id);
        if ($request->category_image == ' ') {
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'updated_to' => Carbon::now(),
            ]);
            return redirect('category');
        } else {
            $current_image = public_path('uploads/category/'.$category->category_image);
            unlink($current_image);

            $img = $request->category_image;
            $extension =  $img->extension();
            $filename = Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . random_int(10, 200) . '.' . $extension;
            $image = Image::make($img)->resize(300, 200)->save(public_path('uploads/category/' . $filename));

            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'category_image' =>$filename,
                'updated_to' => Carbon::now(),
            ]);
            return redirect()->route('category')->with('success','category Update Successfully');
        }
    }
    public function category_soft_delete($category_id){
        Category::find($category_id)->delete();
        return back();
    }
    public function trash(){
        $trash_category = Category::onlyTrashed()->get();
        return view('admin.trash.trash',[
           'trash_category'=>$trash_category,
        ]);
    }
    public function category_restore($id){
        Category::onlyTrashed()->find($id)->restore();
        return back();
    }

    public function category_hard_delete($id){
        $category = Category::onlyTrashed()->find($id);
        $image = public_path('uploads/category/'.$category->category_image);
        unlink($image);

        $subcategory= Subcategory::where('category_id',$id)->get();
        foreach($subcategory as $subcate){
            Subcategory::find($subcate->id)->update([
                'category_id'=>12,
            ]);
        }

        Category::onlyTrashed()->find($id)->forceDelete();
        return back();
    }

    public function category_checked_delete(Request $request){
       foreach($request->category_id as $category){
            Category::find($category)->delete();
            Subcategory::find('category_id',$category)->update([
                'category_id'=>12,
            ]);
       }
       return back();
    }
    public function category_restore_checked(Request $request){
        foreach($request->category_id as $category){
            Category::onlyTrashed()->find($category)->restore();
        }
        return back();
    }
    public function category_restore_delete($id){
        $category = Category::onlyTrashed()->find($id);
        $image = public_path('uploads/category/'.$category->category_image);
        unlink($image);

        Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('delete','Permanently Deleted Successfully');
    }
}
