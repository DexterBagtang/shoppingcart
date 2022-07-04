<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function addproduct(){

        $categories = Category::all()->pluck('category_name','category_name');

        return view('admin.addproduct')->with('categories',$categories);
    }

    public function products(){
        $products = Product::orderBy('id','desc')->get();
        return view('admin.products')->with('products',$products);
    }


    public function saveproduct(Request $request){
        $this->validate($request,[
            'product_name'=>'required',
            'product_price'=>'required',
            'product_category' => 'required',
            'product_image'=> 'image|nullable|max:1999',
            ]);
        if($request->hasFile('product_image')){
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';

        }
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category =$request->input('product_category');
        $product->product_image = $fileNameToStore;
        $product->status = 1;

        $product->save();
        return redirect('/products')->with('status','product added successfully');
    }

    public function editproduct($id){
        $product = Product::find($id);
        $categories = Category::all()->pluck('category_name','category_name');
        return view('admin.editproduct')->with('product',$product)->with('categories',$categories);

    }

    public function updateproduct(Request $request){
        $this->validate($request,[
            'product_name'=>'required',
            'product_price'=>'required',
            'product_category' => 'required',
            'product_image'=> 'image|nullable|max:1999'
        ]);

        $product = Product::find($request->input('id'));
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category =$request->input('product_category');

        if($request->hasFile('product_image')){
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

            if($product->product_image != 'noimage.jpg') {
                Storage::delete('public/product_images/' . $product->product_image);
            }
            $product->product_image = $fileNameToStore;

        }
        $product->Update();
        return redirect('/products')->with('status','product updated successfully');
    }


    public function destroyproduct($id){
        $product = Product::find($id);
        if($product->product_image != 'noimage.jpg') {
            Storage::delete('public/product_images/' . $product->product_image);
        }
        $product->delete();
        return back()->with('status','product deleted successfully');


    }

    public function activateproduct($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->update();

        return back()->with('status','product activated successfully');

    }

    public function deactivateproduct($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->update();

        return back()->with('status','product deactivated successfully');

    }

    public function viewproductcategory($category_name){

        $products = Product::all()->where('product_category',$category_name)->where('status',1);
        $categories = Category::all();
        return view('client.shop')->with('products',$products)->with('categories',$categories);

    }




}
