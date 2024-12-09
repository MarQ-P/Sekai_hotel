<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    
    public function AllTestimonial(){
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial',compact('testimonial'));
    } // End Method 

    public function  AddTestimonial(){

        return view ('backend.testimonial.add_testimonial');

    }

     public function StoreTestimonial(Request $request){
        
        $takeImg = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
        $img = $manager->read($takeImg);
        $img = $img->resize(50,50);
        $img->toJpeg(80)->save(base_path('public/upload/testimonial/' .$name_generate));
        $save_url = 'upload/testimonial/' . $name_generate;


        Testimonial::insert([
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $save_url,
            'created_at' => Carbon::now(),
             
        ]);
        $notification = array(
            'message' => 'Testimonial Data Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.testimonial')->with($notification);
    } // End Method 


    public function EditTestimonial($id){
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial',compact('testimonial'));
    } // End Method 



    public function UpdateTestimonial(Request $request){

        $test_id = $request->id;

        if($request->file('image')){

         $takeImg = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
        $img = $manager->read($takeImg);
        $img = $img->resize(50,50);
        $img->toJpeg(80)->save(base_path('public/upload/testimonial/' .$name_generate));
        $save_url = 'upload/testimonial/' . $name_generate; 
    
            Testimonial::findOrFail($test_id)->update([
    
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $save_url,
            'created_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Testimonial Updated With Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.testimonial')->with($notification);
        } else {
            Testimonial::findOrFail($test_id)->update([
    
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message, 
                'created_at' => Carbon::now(),
                ]);
        
                $notification = array(
                    'message' => 'Testimonial Updated Without Image Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->route('all.testimonial')->with($notification);
        } // End Eles  
    }// End Method 

    public function DeleteTestimonial($id){
        $item = Testimonial::findOrFail($id);
        $img = $item->image;
        unlink($img);
        Testimonial::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }   // End Method 

}
