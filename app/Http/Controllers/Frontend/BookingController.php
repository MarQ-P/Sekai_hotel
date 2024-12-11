<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\Guest;
use App\Models\RoomNumber;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
USE App\Mail\BookConfirm;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\User;
use App\Notifications\BookingComplete;
use Illuminate\support\Facades\Notification;

class BookingController extends Controller
{
    
    use ValidatesRequests;

public function Checkout($id){

    if(Session::has('book_date')){
        $book_data = Session::get('book_date');
        $room = Room::find($book_data['room_id']);

        $fromDate = Carbon::parse($book_data['check_in']);
        $toDate = Carbon::parse($book_data['check_out']);
        $nights = $fromDate->diffInDays($toDate);
      
return view('frontend.checkout.checkout', compact('book_data', 'room', 'nights', 'id'));

    }else{

        $notification = array(
    
            'message' => 'Something went wrong',
            'alert-type' => 'error'
        );
    
        return redirect('/')->with($notification); 

    }//end else

}//end method

public function BookingStore(Request $request ){

$validateData = $request->validate([
'check_in'=> 'required',
'check_out'=> 'required',
'number_of_room'=> 'required',
'person'=> 'required'

]);

if($request->available_room < $request->number_of_room){

    $notification = array(
    
        'message' => 'Something went wrong',
        'alert-type' => 'error'
    );

    return redirect()->back()->with($notification);

}

Session::forget('book_date');

$data = array();
$data['number_of_room'] = $request->number_of_room;
$data['available_room'] = $request->available_room;
$data['person'] = $request->person;
$data['check_in'] = date('Y-m-d', strtotime($request->check_in));
$data['check_out'] = date('Y-m-d', strtotime($request->check_out));
$data['room_id'] = $request->room_id;

Session::put('book_date', $data);

return redirect()->route('checkout', ['id' => $request->room_id]);



}//end method

public function checkoutStore(Request $request, $id){

    $user = User::where('role', 'admin')->get();

    $this->validate($request,[

            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city_municipality' => 'required',
            'zip' => 'required',
            'baranggay' => 'required',
            'payment_method' => 'required',
        ]);
    
        $book_data = Session::get('book_date');
        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);
    
        $room = Room::find($book_data['room_id']);
         $subtotal = $room->price * $total_nights * $book_data['number_of_room'];

        $additional_fee_per_person = 50;

        $extra_persons = max(0, $book_data['person'] - $room->total_adult);

        $additional_fees = $extra_persons * $additional_fee_per_person;

        $subtotal += $additional_fees;

        $discount = ($room->discount / 100) * $subtotal;

        $total_price = $subtotal - $discount;

        $code = rand(000000000, 999999999);
    
        $data = new Booking();
        $data->rooms_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $data->person = $book_data['person'];
        $data->number_of_room = $book_data['number_of_room'];
        $data->total_nights = $total_nights;
        $data->actual_price = $room->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->region = $request->region;
        $data->province = $request->province;
        $data->city_municipality = $request->city_municipality;
        $data->zip = $request->zip;
        $data->baranggay = $request->baranggay;
        $data->code = $code;
        $data->save();
    
        $payment = new Payment();
        $payment->rooms_id = $room->id;
        $payment->booking_id = $data->id;
        $payment->user_id = Auth::user()->id;
        $payment->payment_method = $request->payment_method;
        $payment->payment_status = 0;
        $payment->save();

        foreach ($request->guests as $guestData) {
            $guest = new Guest();
            $guest->booking_id = $data->id; 
            $guest->name = $guestData['name'];
            $guest->age = $guestData['age'];
            $guest->gender = $guestData['gender'];
            $guest->save();
        }

        
        $sdate = date('Y-m-d', strtotime($book_data['check_in']));
        $edate = date('Y-m-d', strtotime($book_data['check_out']));
        $eldate = Carbon::create($edate);
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $room->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }


        $emailData = [
            'check_in' => $data->check_in,
            'check_out' => $data->check_out,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        ];
        
        Mail::to($data->email)->send(new BookConfirm($emailData));
    
        Session::forget('book_date');
    
        $notification = array(
            'message' => 'Booking Added Successfully',
            'alert-type' => 'success'
        );


        Notification::send($user , new BookingComplete($request->name));

        return redirect('/')->with($notification);
    }


////////////////////////////////////////////////////////////////////////////////////////
// back end
/////////////////////////////////////////////////////////////////////////////////////////

public function BookingList()
{
    // Fetch bookings along with payment relationship
    $bookingData = Booking::with('payment')->orderBy('id', 'desc')->get();

    // Pass the data to the view
    return view('backend.booking.booking_list', compact('bookingData'));
}

public function EditBooking( $id){

$editData = Booking::with('room', 'payment', 'guests')->find($id);

$guests = Guest::where('booking_id', $editData->id)->get();

return view('backend.booking.edit_booking', compact('editData', 'guests'));


}//end method

public function UpdateBookingStatus(Request $request, $id){

$booking = Booking::with('payment')->find($id);
$booking->payment->payment_status = $request->payment_status;
$booking->status = $request->status;
$booking->save();
$booking->payment->save();

//send email

$sendmail = Booking::find($id);

$data = [

    'check_in' => $sendmail->check_in,
    'check_out' => $sendmail->check_out,
    'name' => $sendmail->name,
    'email' => $sendmail->email,
    'phone' => $sendmail->phone,

];

Mail::to($sendmail->email)->send(new BookConfirm($data));

//end send email hayssss

$notification = array(
    'message' => 'Booking Information Updated Successfully',
    'alert-type' => 'success'
); 
return redirect()->back()->with($notification);   

}

public function UpdateBooking(Request $request, $id){

if($request->available_room < $request->number_of_room){

    $notification = array(
        'message' => 'Something went Wrong!',
        'alert-type' => 'error'
    ); 
    return redirect()->back()->with($notification);   
}

$data = Booking::find($id);
$data->number_of_room = $request->number_of_room;
$data->check_in = date('Y-m-d', strtotime($request->check_in));
$data->check_out = date('Y-m-d', strtotime($request->check_out));
$data->save();

BookingRoomList::where('booking_id', $id)->delete();
RoomBookedDate::where('booking_id', $id)->delete();

$sdate = date('Y-m-d', strtotime($request->check_in));
$edate = date('Y-m-d', strtotime($request->check_out));
$eldate = Carbon::create($edate);
$d_period = CarbonPeriod::create($sdate, $eldate);
foreach ($d_period as $period) {
    $booked_dates = new RoomBookedDate();
    $booked_dates->booking_id = $data->id;
    $booked_dates->room_id = $data->rooms_id;
    $booked_dates->book_date = date('Y-m-d', strtotime($period));
    $booked_dates->save();
}

$notification = array(
    'message' => 'Booking Updated Successfully',
    'alert-type' => 'success'
); 
return redirect()->back()->with($notification);   

}//end methopd

public function AssignRoom($booking_id){
 
$booking = Booking::find($booking_id);

$booking_date_array = RoomBookedDate::where('booking_id', $booking_id)->pluck('book_date')->toArray();

$check_date_booking_ids = RoomBookedDate::whereIn('book_date', $booking_date_array)->where('room_id', 
$booking->rooms_id)->distinct()->pluck('booking_id')->toArray();

$booking_ids = Booking::whereIn('id', $check_date_booking_ids)->pluck('id')->toArray();

$assign_room_ids = BookingRoomList::whereIn('booking_id', $booking_ids)->pluck('room_number_id')->toArray();

$room_numbers = RoomNumber::where('rooms_id', $booking->rooms_id)->whereNotIn('id', $assign_room_ids)
->where('status', 'Active')->get();

return view('backend.booking.assign_room', compact('booking', 'room_numbers'));


}

public function AssignRoomStore ($booking_id, $room_number_id){

$booking = Booking::find($booking_id);
$check_data = BookingRoomList::where('booking_id', $booking_id)->count();

if($check_data < $booking->number_of_room){
$assign_data = new BookingRoomList();
$assign_data ->booking_id = $booking_id;
$assign_data->room_id = $booking->rooms_id;
$assign_data->room_number_id  = $room_number_id;
$assign_data->save();


$notification = array(
    'message' => 'Room Assign Successfully',
    'alert-type' => 'success'
); 
return redirect()->back()->with($notification);  

}else{

    $notification = array(
        'message' => 'Maximum of Room Already Assign ',
        'alert-type' => 'warning'
    ); 
    return redirect()->back()->with($notification);  

}

}//end method


public function AssignRoomDelete($id){

$assign_room = BookingRoomList::find($id);
$assign_room->delete();

    $notification = array(
        'message' => 'Assigned Room Deleted Successfully',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($notification);  

}//end method

public function DownloadInvoice ($id){

$editData = Booking::with('room')->find($id);
$pdf = Pdf::loadView('backend.booking.booking_invoice', compact('editData'))
->setPaper('a4')->setOption([

'tempDir' => public_path(),
'chroot' => public_path()

]);

return $pdf->download('invoice.pdf');

}//end methodds

public function UserBooking (){

$id = Auth::user()->id;
$allData = Booking::where('user_id', $id)->orderBy('id', 'desc')->get();

return view ('frontend.dashboard.user_booking', compact('allData'));

}//end method

public function UserInvoice($id){

    $editData = Booking::with('room')->find($id);
    $pdf = Pdf::loadView('backend.booking.booking_invoice', compact('editData'))
    ->setPaper('a4')->setOption([
    
    'tempDir' => public_path(),
    'chroot' => public_path()
    
    ]);
    
    return $pdf->download('invoice.pdf');

}//end methid

public function ConfirmBooking($id) {

    $booking = Booking::find($id);


    return view('mail.booking_mail', compact('booking'));
}

// public function MarkAsRead(Request $request , $notificationId){
//     $user = Auth::user();
//     $notification = $user->notifications()->where('id',$notificationId)->first();
//     if ($notification) {
//         $notification->markAsRead();
//     }
// return response()->json(['count' => $user->unreadNotifications()->count()]);
//  }// End Method 

}


