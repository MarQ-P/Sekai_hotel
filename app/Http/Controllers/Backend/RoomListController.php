<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\RoomBookedDate;
use App\Models\BookingRoomList;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;

class RoomListController extends Controller
{


    //which room is available and which is not LORDDDD TABANGIIII
    public function ViewRoomList(){

        $room_number_list = RoomNumber::with(['room_type','last_booking.booking:id,check_in,check_out,status,code,name,phone'])->orderBy('room_type_id','asc')
        ->leftJoin('room_types','room_types.id','room_numbers.room_type_id')
        ->leftJoin('booking_room_lists','booking_room_lists.room_number_id','room_numbers.id')
        ->leftJoin('bookings','bookings.id','booking_room_lists.booking_id')
        ->select(
           'room_numbers.*',
           'room_numbers.id as id',
           'room_types.name',
           'bookings.id as booking_id',
           'bookings.check_in',
           'bookings.check_out',

           'bookings.name as customer_name',
           'bookings.phone as customer_phone',
           'bookings.status as booking_stauts',
           'bookings.code as booking_no'
        )
        ->orderBy('room_types.id','asc')
        ->orderBy('bookings.id','desc')
        ->get();
        return view('backend.allroom.roomlist.view_roomlist',compact('room_number_list'));

    }//End Method


    public function AddRoomList (){

        $roomtype = RoomType::all();
        return view('backend.allroom.roomlist.add_roomlist', compact('roomtype'));

    }// end method


    public function StoreRoomList(Request $request){
        if ($request->check_in == $request->check_out) {
         $request->flash();
         $notification = array(
             'message' => 'You Enter Same Date',
             'alert-type' => 'error'
         );
 
         return redirect()->back()->with($notification);
        }
        if ($request->available_room < $request->number_of_rooms) {
         $request->flash();
         $notification = array(
             'message' => 'You Enter Maximum Number of Rooms!',
             'alert-type' => 'error'
         );
 
         return redirect()->back()->with($notification);
        }

        $room = Room::find($request['room_id']);

    
        if ($room->room_capacity < $request->number_of_person ) {
         $notification = array(
             'message' => 'You Enter Maximum Number of Guest!',
             'alert-type' => 'error'
         );
 
         return redirect()->back()->with($notification);
        }

         
        $toDate = Carbon::parse($request['check_in']);
        $fromDate = Carbon::parse($request['check_out']);
        $total_nights = $toDate->diffInDays($fromDate); 
        
        $subtotal = $room->price * $total_nights * $request->number_of_room;
        $discount = ($room->discount/100)*$subtotal;
        $total_price = $subtotal-$discount;
        $code = rand(000000000,999999999); 

        $data = new Booking();
        $data->rooms_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d',strtotime($request['check_in']));
        $data->check_out = date('Y-m-d',strtotime($request['check_out']));
        $data->person = $request->number_of_person;
        $data->number_of_room = $request->number_of_room;
        $data->total_nights = $total_nights;
        $data->actual_price = $room->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->Region = $request->Region;
        $data->Province = $request->Province;
        $data->Zip = $request->Zip;
        $data->City_Municipality = $request->City_Municipality;
        $data->Baranggay = $request->Baranggay;
        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();
        $data->save();

       $payment = new Payment();
       $payment->rooms_id = $room->id;
       $payment->booking_id = $data->id;
       $payment->user_id = Auth::user()->id;
       $payment->payment_method = 'PATH';
       $payment->transaction_id = '';
       $payment->payment_status = 0;
       $payment->save();

     $sdate = date('Y-m-d',strtotime($request['check_in']));
     $edate = date('Y-m-d',strtotime($request['check_out']));
     $eldate = Carbon::create($edate);
     $d_period = CarbonPeriod::create($sdate,$eldate);

     foreach ($d_period as $period) {
         $booked_dates = new RoomBookedDate();
         $booked_dates->booking_id = $data->id;
         $booked_dates->room_id = $room->id;
         $booked_dates->book_date = date('Y-m-d', strtotime($period));
         $booked_dates->save();
     }

     $notification = array(
         'message' => 'Booking Added Successfully',
         'alert-type' => 'success'
     ); 
     return redirect()->back()->with($notification);  
 }// End Method 

}