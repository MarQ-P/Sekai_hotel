<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    use HasFactory;
    protected $guarded = [];

    public function assign_rooms( ){

    return $this->hasMany(BookingRoomList::class, "booking_id");

    }//End mEthod

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'booking_id', 'id');
    }
    

    public function room(){
        return $this->belongsTo(Room::class, 'rooms_id', 'id');
    }


}
