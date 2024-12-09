<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    
    public function AllPermission (){

        $permission = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permission'));

    }//end method

    public function AddPermission (){

        return view('backend.pages.permission.add_permission');

    }//end method

    public function StorePermission(Request $request){
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification); 
    } // End Method 

    public function EditPermission($id){

        $permission = Permission::find($id);
        
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }// End Method 

    public function UpdatePermission(Request $request){

        $per_id = $request->id;
        Permission::find($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification); 

    } // End Method 

    public function DeletePermission($id){

        Permission::find($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function AllRoles(){

        $roles = Role::latest()->get();
        return view('backend.pages.roles.all_roles',compact('roles'));

    }// End Method

    public function AddRoles(){

        return view('backend.pages.roles.add_roles');

    }// End Method

    public function StoreRoles(Request $request){
        
        Role::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);  

    }// End Method

    public function EditRoles($id){

        $roles = Role::find($id);

        return view('backend.pages.roles.edit_roles',compact('roles'));

    }// End Method
    
    public function UpdateRoles(Request $request){
        $role_id = $request->id;

        Role::find($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);   

    }// End Method

    public function DeleteRoles($id){

        Role::find($id)->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);   

    }// End Method

    public function AddRolesPermission(){
        
        $roles = Role::all();

        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permissions','permission_groups'));

    }// End Method

    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } // end foreach
        
        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification); 

    }// End Method


    public function AllRolesPermission(){

        $roles = Role::all();
        return view ('backend.pages.rolesetup.all_roles_permission', compact('roles'));


    }

    public function AdminEditRoles($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permissions','permission_groups'));
    }// End Method


    public function AdminRolesUpdate(Request $request, $id)
    {
        $role = Role::find($id); // Retrieve the role by ID
        $permissions = $request->permission;
    
        if (!empty($permissions)) {
            // Convert permission IDs to their names
            $permissionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames); // Sync permissions using names
        } else {
            // Clear all permissions if none are selected
            $role->syncPermissions([]);
        }
    
        $notification = [
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id){

        $role = Role::find($id);
        
        if (!is_null($role)) {
           $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

}

