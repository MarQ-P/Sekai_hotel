<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class FrontendRoomController extends Controller
{
    
    public function AllRoomFrontendRoomList(){

        $rooms = Room::latest()->get();

        return view("frontend.room.all_rooms",compact("rooms"));

    }

    public function RoomDetailsPage($id){
        $roomdetails = Room::findOrFail($id);
        $multiImage = MultiImage::where('rooms_id', $id)->get();
        $facility = Facility::where('rooms_id', $id)->get();

        $otherRooms = Room::where('id' ,'!=' , $id)->orderBy('id','DESC')->limit(2)->get();
        return view("frontend.room.room_details", compact("roomdetails", "multiImage", "facility", "otherRooms"));
    }//End method
    

    
public function BookingSearch(Request $request){

    //used to store input all data into the session for the single use
$request->flash();

if($request->check_in == $request->check_out){

    $notification = array(
    
        'message' => 'Something went wrong',
        'alert-type' => 'error'
    );

    return redirect()->back()->with($notification);

}

$Sdate = date('Y-m-d', strtotime($request->check_in));
$Edate = date('Y-m-d', strtotime($request->check_out));
$alldate = Carbon::create($Edate)->subDay();
$d_period = CarbonPeriod::create($Sdate, $alldate);
$dt_array = [];
foreach ($d_period as $period){
array_push($dt_array, date('Y-m-d', strtotime($period)));
}

$check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();

    $rooms = Room::withCount('room_numbers')->where('status', 1 )->get();

    return view('frontend.room.search_room', compact('rooms', 'check_date_booking_ids'));
}//end method


public function SearchRoomDetails(Request $request, $id){

    $request->flash();
    $roomdetails = Room::findOrFail($id);
    $multiImage = MultiImage::where('rooms_id', $id)->get();
    $facility = Facility::where('rooms_id', $id)->get();

    $otherRooms = Room::where('id' ,'!=' , $id)->orderBy('id','DESC')->limit(2)->get();

    $room_id = $id;
    
    return view("frontend.room.search_room_details", compact("roomdetails", "multiImage", "facility", "otherRooms", 'room_id'));


}//endMETHOD

public function CheckRoomAvailability(Request $request){
    $sdate = date('Y-m-d',strtotime($request->check_in));
    $edate = date('Y-m-d',strtotime($request->check_out));
    $alldate = Carbon::create($edate)->subDay();
    $d_period = CarbonPeriod::create($sdate,$alldate);
    $dt_array = [];
    foreach ($d_period as $period) {
       array_push($dt_array, date('Y-m-d', strtotime($period)));
    }
    $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

    $room = Room::withCount('room_numbers')->find($request->room_id);

    $bookings = Booking::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('rooms_id',$room->id)->get()->toArray();
   
    $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));

    $av_room = @$room->room_numbers_count-$total_book_room;

    $toDate = Carbon::parse($request->check_in);
    $fromDate = Carbon::parse($request->check_out);

    $nights = $toDate->diffInDays($fromDate);

    return response()->json(['available_room'=>$av_room, 'total_nights'=>$nights ]);
}

}