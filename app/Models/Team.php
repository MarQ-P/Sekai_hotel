<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'team_id'; 
     public $incrementing = true;
        protected $guarded = [];
}
