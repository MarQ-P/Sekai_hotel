<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Team;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Room;


class RoomTypeController extends Controller
{
    
public function RoomTypeList(){

$allData = RoomType::orderBy('id', 'desc')->get();
return view('backend.allroom.roomtype.view_roomtype',compact('allData'));

}

public function AddRoomType(){

return view('backend.allroom.roomtype.add_roomtype');

}

public function RoomTypeStore(Request $request){

    $roomtype_id = RoomType::insertGetId([
        'name'=> $request->name,      
    ]);

 

    Room::insert([
        'roomtype_id'=> $roomtype_id,
    ]);


    $notification = array(
    
        'message' => 'Room Type Data inserted Succesfully',
        'alert-type' => 'success'
    );

    return redirect()->route('room.type.list')->with($notification);

}

}
