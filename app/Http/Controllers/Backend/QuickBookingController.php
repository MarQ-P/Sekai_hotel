<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuickBooking;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class QuickBookingController extends Controller
{
    
    public function QuickBooking(){

        $quickBooking = QuickBooking::find(1);
        return view("backend.QuickBooking.quick_booking",compact("quickBooking"));
    
    }//end method

    public function UpdateQuickBooking(Request $request){

        $quickbooking_id = $request->id;

        if ($request->file('image')){
            $takeImg = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
        $img = $manager->read($takeImg);
        $img = $img->resize(1000,1000);
        
        $img->toJpeg(80)->save(base_path('public/upload/quickBooking_images/' .$name_generate));
        $save_url = 'upload/quickBooking_images/' . $name_generate;
        
        QuickBooking::findOrFail($quickbooking_id)->update([
        
        'short_title'=> $request->short_title,
        'main_title'=> $request->main_title,
        'short_desc'=> $request->short_desc,
        'link_url'=> $request->link_url,
        'image'=> $save_url,
        
        ]);
        
        $notification = array(
        
            'message' => 'Quick Booking Update Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification); 
        
        }else{
            
            
            QuickBooking::findOrFail($quickbooking_id)->update([
            
                'short_title'=> $request->short_title,
                'main_title'=> $request->main_title,
                'short_desc'=> $request->short_desc,
                'link_url'=> $request->link_url,
              
            
            ]);
            
            $notification = array(
        
                'message' => 'Quick Booking Update Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification); 
        
        }

    }

}
