<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function categories(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.categories')->with('categories',$category);
    }

    public function addcategory(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.addcategory');
    }

    public function savecategory(Request $request){
        $this->validate($request,['category_name'=>'required|unique:categories']);
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        return back()->with('status','The category is succesfully saved !');
    }
    public function editcategory($id){
        $category = Category::find($id);
        return view('admin.editcategory')->with('category',$category);
    }

    public function updatecategory(Request $request){
        //echo $request->input('id') . $request->input('category_name');
        $this->validate($request,['category_name'=>'required']);
        $category = Category::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->update();
        return redirect('/categories')->with('status','Succesfully Edited');
    }

    public function deletecategory($id){
        $category = Category::find($id);
        $category->delete();
        return back()->with('status','Succesfully Deleted');

    }
}
