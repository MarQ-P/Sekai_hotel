<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class TeamController extends Controller
{
    //Start Method
    public function AllTeam(){

        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));

    } //End Method
   
public function AddTeam(){

return view('backend.team.add_team');

}//End Method

public function StoreTeam(Request $request){

    if ($request->file('image')){
        $takeImg = $request->file('image');
$manager = new ImageManager(new Driver());
$name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
$img = $manager->read($takeImg);
$img = $img->resize(550,670);

$img->toJpeg(80)->save(base_path('public/upload/team_images/' .$name_generate));
$save_url = 'upload/team_images/' . $name_generate;

Team::insert([

    'name'=> $request->name,
    'position'=> $request->position,
    'image'=> $save_url,
   
]);

    }

    $notification = array(
    
        'message' => 'Team Data inserted Succesfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.team')->with($notification);


}//End Method

public function EditTeam($team_id){

$team = Team::findOrFail($team_id);

return view ('backend.team.edit_team', compact('team'));
}

public function UpdateTeam(Request $request){

$team_id = $request->id;

if ($request->file('image')){
    $takeImg = $request->file('image');
$manager = new ImageManager(new Driver());
$name_generate = hexdec(uniqid()).'.'.$takeImg->getClientOriginalExtension();
$img = $manager->read($takeImg);
$img = $img->resize(550,670);

$img->toJpeg(80)->save(base_path('public/upload/team_images/' .$name_generate));
$save_url = 'upload/team_images/' . $name_generate;

Team::findOrFail($team_id)->update([

'name'=> $request->name,
'position'=> $request->position,
'image'=> $save_url,

]);

$notification = array(

    'message' => 'Team Update Succesfully',
    'alert-type' => 'success'
);

return redirect()->route('all.team')->with($notification); 

}else{
    
    
    Team::findOrFail($team_id)->update([
    
    'name'=> $request->name,
    'position'=> $request->position,
    
    ]);
    
    $notification = array(
    
        'message' => 'Team Update Succesfully',
        'alert-type' => 'success'
    );
    
    return redirect()->route('all.team')->with($notification); 

}

} //end method

public function DeleteTeam($team_id){

    $item = Team::findOrFail($team_id);
    $img = $item->image;
    unlink($img);

    Team::findOrFail($team_id)->delete();

    $notification = array(
    
        'message' => 'Team Deleted Succesfully',
        'alert-type' => 'success'
    );
    
    return redirect()->back()->with($notification); 

}

}


