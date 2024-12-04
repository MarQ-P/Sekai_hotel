<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomList extends Model
{
    
    use HasFactory;
    protected $guarded = [];


    //RelationSHips
    public function room_number(){

        return $this->belongsTo(Roomnumber::class, 'room_number_id');

    }

    //RelationSHips
    public function booking(){

        return $this->belongsTo(Booking::class, 'booking_id');

    }

}
