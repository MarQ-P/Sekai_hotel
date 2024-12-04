<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
public function Index(){

    return view("frontend.index");
}

public function UserProfile(){
    $id = Auth::user()->id;
    $profileData = User::find($id);
    return view('frontend.dashboard.edit_profile', compact('profileData'));
}

    //start method
    public function UserProfileStore(Request $request){
 
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'. $data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename; 
        }
    
        $data->save();
    
        $notification = array(
    
            'message' => 'User Profile Updated Succesfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
        
         }
        // End method

        public function UserLogout(Request $request)
        {
            Auth::guard('web')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();

            $notification = array(
    
                'message' => 'LogOut Succesfully',
                'alert-type' => 'success'
            );
    
            return redirect('/login')->with($notification
        );
        }
        // End method

        public function UserChangePassword(){
    return view('frontend.dashboard.user_change_password');

        }

        // method start
public function UserChangeUpdate(Request $request){

    //validation
    $request->validate([
        "old_password" => 'required', 
        'new_password'=> 'required|confirmed' 
    ]);
    
    if(!Hash::check($request->old_password, Auth::user()->password)){
    
        $notification = array(
    
            'message' => 'Old Password Does not match',
            'alert-type' => 'warning'
        );
    
        return back()->with($notification);
    
    }
    //update password
    User::whereId(auth::user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);
    
    $notification = array(
    
        'message' => ' Password change successfully',
        'alert-type' => 'success'
    );
    
    return back()->with($notification);
    
    }
    // End method
}
