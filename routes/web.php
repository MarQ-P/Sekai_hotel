<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\QuickBooking;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\QuickBookingController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoleController;





// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);
    


Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserChangeUpdate'])->name('user.password.update');


});

require __DIR__.'/auth.php';

//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post ('/admin/profile', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get ('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post ('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');


}); //End of the admin group midleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){

    //Team all Route
Route::controller(TeamController::class)->group(function(){

    Route::get('/all/team', 'AllTeam')->name('all.team');
    Route::get('/add/team', 'AddTeam')->name('add.team');
    Route::post('/team/store', 'StoreTeam')->name('team.store');
    Route::get('/edit/team/{team_id}', 'EditTeam')->name('edit.team');
    Route::post('/team/update', 'UpdateTeam')->name('team.update');
    Route::get('/delete/team/{team_id}', 'DeleteTeam')->name('delete.team');
    Route::get('/archieve/team', 'ArchieveTeam')->name('archieve.team');
    Route::get('/restore/team/{team_id}', 'RestoreTeam')->name('restore.team');
    Route::get('/force-delete/team/{team_id}', 'ForceDeleteTeam')->name('forceDelete.team');


});//end team middleware


//QuickBooking Controller
Route::controller(QuickBookingController::class)->group(function(){

    Route::get('/quick/Booking', 'QuickBooking')->name('quickBooking');
    Route::post('/update/quick/Booking', 'UpdateQuickBooking')->name('quick.booking.updated');


});//end 

//Room Type CONtroller
Route::controller(RoomTypeController::class)->group(function(){

    Route::get('/Room/type/list', 'RoomTypeList')->name('room.type.list');
    Route::get('/Add/Room/type/', 'AddRoomType')->name('add.room.type');
    Route::post('/Room/type/Store/', 'RoomTypeStore')->name('room.type.store');


});//end 

//Room  ALL rOUTE
Route::controller(RoomController::class)->group(function(){

    Route::get('/Edit/room/{id}/', 'EditRoom')->name('edit.room');
    Route::get('/Delete/room/{id}/', 'DeleteRoom')->name('delete.room');
    Route::post('/Update/room/{id}/', 'UpdateRoom')->name('update.room');
    Route::get('/archieve/room', 'ArchieveRoom')->name('archieve.room');
    Route::get('/restore/room/{id}', 'RestoreRoom')->name('restore.room');
    Route::get('/force-delete/room/{id}', 'ForceDeleteRoom')->name('forceDelete.room');
    Route::get('/multi/images/delete/{id}/', 'MultiImagesDelete')->name('multi.image.delete');

    Route::post('/store/room/number/{id}/', 'StoreRoomNUmber')->name('store.roomNumber');
    Route::get('/edit/room/number/{id}/', 'EditRoomNUmber')->name('edit.roomNumber');
    Route::post('/update/room/number/{id}/', 'UpdateRoomNUmber')->name('update.roomNumber');
    Route::get('/delete/room/number/{id}/', 'DeleteRoomNUmber')->name('delete.roomNumber');
    
 

});//end 


Route::controller(BookingController::class)->group(function(){

    Route::get('/booking/list', 'BookingList')->name('booking.list');
    Route::get('/edit/booking/{id}', 'EditBooking')->name('edit.booking');
    Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
    
    //email confirm booking
});//end 


//Admin Room List
Route::controller(RoomListController::class)->group(function(){

    Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list');

    Route::get('/Add/room/list', 'AddRoomList')->name('add.room.list');
    //bookng.list.blade.php
    Route::get('/delete/booking/list/{id}', 'DeleteBookingList')->name('delete.booking.list');
    
    //add_roomlist
    Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist'); 

    Route::get('/archieve/bookinglist/', 'ArchieveBookingList')->name('archieve.bookinglist');
    Route::get('/restore/bookinglist/{id}', 'RestoreBookingList')->name('restore.bookinglist');
    Route::get('/forcedelete/bookinglist/{id}', 'ForceDeleteBookingListl')->name('forcedelete.bookinglist');

});//end 


//Admin Room List
Route::controller(SettingController::class)->group(function(){

    //sidebar hohaaa hahaha
    Route::get('/smtp/room/list', 'SmtpSetting')->name('smtp.setting');
    Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');


});//end 

/// Booking Report All Route 
Route::controller(ReportController::class)->group(function(){ 
    Route::get('/booking/report/', 'BookingReport')->name('booking.report');
    Route::post('/search-by-date', 'SearchByDate')->name('search-by-date');
     
});
//permisioon all routee
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add.permission');
    Route::post('/store/permission', 'StorePermission')->name('store.permission');

    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

      
});
//role all routee
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/roles', 'AllRoles')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->name('add.roles');
    Route::post('/store/roles', 'StoreRoles')->name('store.roles');

    // roles//
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
    Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

    //add_roles_permission
    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');

    //edit_roles_permission
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
    Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
    Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
 
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/all/admin', 'AllAdmin')->name('all.admin'); 
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    Route::get('/archieve/admin/', 'ArchieveAdmin')->name('archieve.admin');
    Route::get('/restore/admin/{id}', 'RestoreAdmin')->name('restore.admin');
    Route::get('/forcedelete/admin/{id}', 'ForceDeleteAdmin')->name('forcedelete.admin');

});

});//End admin group middleware


Route::controller(FrontendRoomController::class)->group(function(){

    Route::get('/rooms/', 'AllRoomFrontendRoomList')->name('f_end_room.all');
    Route::get('/rooms/', 'AllRoomFrontendRoomList')->name('f_end_room.all');
    Route::get('/room/details/{id}', 'RoomDetailsPage')->name('room.details');
    Route::get('/bookings/', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');

    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');


    

});//End group middleware

//Auth Midlleware dapat naka log in si user bago maka book ana si maam hannah AHHAHHAHAHHAHAHA
Route::middleware(['auth' ])->group(function(){


    //CHECKOUT ALL ROUTE
    Route::controller(BookingController::class)->group(function(){

        Route::get('/checkout/{id}/', 'Checkout')->name('checkout');
        Route::post('/booking_store/', 'BookingStore')->name('user_booking_store');
        Route::post('/checkout/store/{id}/', 'checkoutStore')->name('checkout.store');

        //booking updateeahhhhhhhhhhhhhhhhhhhhhhhhhhb kapoyaaaa
        Route::post('/update/booking/status/{id}/', 'UpdateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}/', 'UpdateBooking')->name('update.booking');

        //Assign Room
        Route::get('/assign/room/{id}/', 'AssignRoom')->name('assign_room');
        Route::get('/assign/room/store/{booking_id}/{room_number_id}/', 'AssignRoomStore')->name('assign_room_store');
        Route::get('/assign/room/delete/{id}/', 'AssignRoomDelete')->name('assign_room_delete');

        /////user booking routeeeeee
        Route::get('/user/booking/', 'UserBooking')->name('user.booking');
        Route::get('/user/invoice/{id}/', 'UserInvoice')->name('user.invoice');


        //email confimration
        Route::get('/confirm/booking/{id}/', 'ConfirmBooking')->name('confirm.booking');
    
    });//End bookingCONTROLLER middleware

});//End auth middleware

//testimonialk
Route::controller(TestimonialController::class)->group(function(){
    //backend.testimonial.all_testimonial
    Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial'); 
    Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial'); 
    Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store'); 
    Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
    Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update'); 
    Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    Route::get('/archieve/testimonial/', 'ArchieveTestimonial')->name('archieve.testimonial');
    Route::get('/restore/testimonial/{id}', 'RestoreTestimonial')->name('restore.testimonial');
    Route::get('/forcedelete/testimonial/{id}', 'ForceDeleteTestimonial')->name('forcedelete.testimonial');

});

Route::controller(BookingController::class)->group(function(){
 
    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
   
 
});


//Confirm Booking

