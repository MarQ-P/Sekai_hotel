<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    

    use HasFactory;

       protected $guarded = [];

       //one to one relationship :::< 
       public function room_type(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
       }

       //one to many (patuloga nako please )
       public function last_booking(){
        return $this->hasOne(BookingRoomList::class, 'room_number_id')->latest();

       }

}
