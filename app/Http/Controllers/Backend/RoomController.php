<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\RoomNumber;
use App\Models\RoomType;
use PhpParser\Node\Stmt\If_;

class RoomController extends Controller
{

public function EditRoom($id){

$basic_facility = Facility::where('rooms_id', $id)->get();     
$multiImgs = MultiImage::where('rooms_id', $id)->get();     
$editData = Room::find($id);
$allRoomNumber = RoomNumber::where('rooms_id', $id)->get();
return view("backend.allroom.rooms.edit_room", compact("editData", 'basic_facility', 'multiImgs', 'allRoomNumber'));

}

//UpdateRoom para ma saved ang mga gipang butang sa edit :>
public function UpdateRoom( Request $request, $id){

    //request data for this fields
$Uroom = Room::find($id);
$Uroom->roomtype_id;
$Uroom->total_adult = $request->total_adult;
$Uroom->total_child = $request->total_child;
$Uroom->room_capacity = $request->room_capacity;
$Uroom->price = $request->price;

$Uroom->size = $request->size;
$Uroom->view = $request->view;
$Uroom->bed_style = $request->bed_style;
$Uroom->discount = $request->discount;
$Uroom->short_desc = $request->short_desc;
$Uroom->description = $request->description; 
$Uroom->status = 1; 



//Update SIngle Image kato thumbnail

if($request->file('image')){

    if ($request->file('image')){
$takeImg = $request->file('image');
$manager = new ImageManager(new Driver());
$name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
$img = $manager->read($takeImg);
$img = $img->resize(550,850);

$img->toJpeg(80)->save(base_path('public/upload/roomImg/' .$name_generate));
$Uroom['image'] = $name_generate;

}
}

$Uroom->save();

//Facility na part
if($request->facility_name == null){
 
    $notification = array(
    
        'message' => 'Please add some facilities!',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}else{

Facility::where('rooms_id',$id)->delete();
$facilities = Count($request->facility_name);
for($i=0; $i < $facilities; $i++){
    $facilitiesCount =  new Facility();
    $facilitiesCount->rooms_id = $Uroom->id;
    $facilitiesCount->facility_name = $request->facility_name[$i];
    $facilitiesCount->save();
}//end for
}//end else 

//update multi images 

if($Uroom->save()){
$files = $request->multi_img;
if(!empty($files)) {
$subimage = MultiImage::where('rooms_id', $id)->get()->toArray();
MultiImage::where('rooms_id' ,$id)->delete();
}

if(!empty($files)){
foreach($files as  $file){
    $imgName = date('YmdHi'). $file->getClientOriginalName();
$file->move('upload/roomImg/multiImg', $imgName);
$subimage['multi_img'] = $imgName;

$subimage = new MultiImage();
$subimage->rooms_id = $Uroom->id;
$subimage->multi_img = $imgName;
$subimage->save();


}

}
}//end if condition


$notification = array(
    
    'message' => 'Room Updated Successfully!',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);

}//updateRoom End method kapoya nimo oioiiioio!


public function MultiImagesDelete($id){

$deleteData = MultiImage::where('id', $id)->first();

if($deleteData){

$imagePath = $deleteData->multi_img;

//Check if nag exist ang file before eh unlink

if(file_exists($imagePath)) {
unlink($imagePath);
echo "Image Unlinked successfully";
}else{
    echo "Image does not Exist";
}

//DELETE THE RECORD SA DATABASE

MultiImage::where('id', $id)->delete();

}

$notification = array(
    
    'message' => 'Multi Image Deleted Successfully!',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);


}//End method multimages

public function StoreRoomNumber(Request $request, $id){

$data = new RoomNumber();
$data->rooms_id= $id;
$data->room_type_id = $request->room_type_id;
$data->room_no = $request->room_no;
$data->status = $request->status;
$data->save();

$notification = array(
    
    'message' => 'Room Number Added Successfully!',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);

}//End Method

public function EditRoomNumber( $id){

$editroomNumber =  RoomNumber::find($id);
return view ('backend.allroom.rooms.edit_room_number', compact('editroomNumber'));

}//ENd store room number

public function UpdateRoomNumber(Request $request, $id){


    $data = RoomNumber::find( $id);
    $data->room_no = $request->room_no;
    $data->status = $request->status;
    $data->save();

    $notification = array(
    
        'message' => 'Room Number Updated Successfully!',
        'alert-type' => 'success'
    );
    
    return redirect()->route('room.type.list')->with($notification);

}

public function DeleteRoomNumber(Request $request, $id){

RoomNumber::find($id)->delete();

$notification = array(
    
    'message' => 'Room Number Deleted Successfully!',
    'alert-type' => 'success'
);

return redirect()->route('room.type.list')->with($notification);

}

public function DeleteRoom(Request $request, $id){

$room = Room::find( $id );

if(file_exists('upload/roomImg/'.$room->image) AND ! empty($room->image)){
@unlink('upload/roomImg/'. $room->image);
}

$multi_image = MultiImage::where('rooms_id', $room->id)->get()->toArray() ;

if(!empty($multi_image)){
    foreach($multi_image as $images){
        if(!empty($images)){
@unlink('upload/roomImg/multiImg'. $images['multi_img']);
        }
}

}

RoomType::where('id', $room->roomtype_id)->delete();
MultiImage::where('rooms_id', $room->$id)->delete();
Facility::where('rooms_id', $room->id)->delete();
RoomNumber::where('rooms_id', $room->$id)->delete();
$room->delete();

$notification = array(
    
    'message' => 'Room Deleted Successfully!',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);

}//end method

}