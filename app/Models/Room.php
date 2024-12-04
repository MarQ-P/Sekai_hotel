<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    
    use HasFactory;

       protected $guarded = [];

       public function roomtype(){
        return $this->belongsTo(RoomType::class, 'roomtype_id', 'id');
    }

    public function room_numbers(){
        return $this->hasMany(RoomNumber::class,'rooms_id')->where('status', 'Active');
    }
}
