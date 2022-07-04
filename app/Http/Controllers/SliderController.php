<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function addslider(){
        return view('admin.addslider');
    }

    public function slider(){
        $slider = Slider::all();
        return view('admin.slider ')->with('slider',$slider);
    }

    public function saveslider(Request $request){
        $this->validate($request,[
            'description1'=>'required',
            'description2'=>'required',
            'sliderimage'=> 'image|nullable|max:1999'
        ]);

        if($request->hasFile('sliderimage')){
            $fileNameWithExt = $request->file('sliderimage')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('sliderimage')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('sliderimage')->storeAs('public/slider_images',$fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';

        }

        $slider = new Slider();
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->sliderimage = $fileNameToStore;
        $slider->status = 1;

        $slider->save();
        return back()->with('status','slider added successfully');

    }
    public function editslider($id){
        $slider = Slider::find($id);
        return view('admin.editslider')->with('slider',$slider);
    }

    public function updateslider(Request $request)
    {
        $this->validate($request, [
            'description1' => 'required',
            'description2' => 'required',
            'sliderimage' => 'image|nullable|max:1999'
        ]);
        $slider = Slider::find($request->input('id'));

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');

        if ($request->hasFile('sliderimage')) {
            $fileNameWithExt = $request->file('sliderimage')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('sliderimage')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('sliderimage')->storeAs('public/slider_images', $fileNameToStore);

            if ($slider->sliderimage != 'noimage.jpg') {
                Storage::delete('public/slider_images/' . $slider->sliderimage);
            }
            $slider->sliderimage = $fileNameToStore;
        }
        $slider->Update();
        return redirect('/slider')->with('status', 'slider updated successfully');
    }


    public function destroyslider($id){
        $slider = Slider::find($id);
        if($slider->sliderimage != 'noimage.jpg') {
            Storage::delete('public/slider_images/' . $slider->sliderimage);
        }
        $slider->delete();
        return back()->with('status','slider deleted successfully');


    }

    public function activateslider($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->update();

        return back()->with('status','slider activated successfully');

    }

    public function deactivateslider($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->update();

        return back()->with('status','slider deactivated successfully');

    }




}
