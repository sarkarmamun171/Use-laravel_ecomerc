<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function category_subcategory(){
        $categories=Category::all();
        return view('admin.subcategory.subcategory',[
            'categories'=> $categories,
        ]);
    }
    function category_subcategory_store(Request $request){
        $request->validate([
            'category'=>'required',
            'subcategory_name'=>'required',
        ]);

        if(Subcategory::where('category_id',$request->category)->where('Subcategory_name',$request->subcategory_name)->exists())
        {
            return back()->with('exit','Already exits');
        }else
        {
            Subcategory::insert([
                'category_id'=>$request->category,
                'Subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);

            return back()->with('success','Subcategory added successfully');
        }
    }
    public function subcategory_edit($id){
        $categories=Category::all();
        $subcategory=Subcategory::find($id);
        return view('admin.subcategory.subcate_edit',[
            'categories'=> $categories,
            'subcategory'=>$subcategory,
        ]);
    }
    public function subcategory_update(Request $request,$id){
        Subcategory::find($id)->update([
            'category_id'=>$request->category,
            'Subcategory_name'=>$request->subcategory_name,
            'updated_at'=>Carbon::now(),
        ]);
        return back()->with('success','Subcategory added Successfully');
    }
    public function subcategory_delete($id){
        Subcategory::find($id)->delete();
        return back()->with('delete','Subcategory delete successfully');

    }
}
