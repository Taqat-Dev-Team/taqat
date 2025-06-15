<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomHistory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function rooms(){
        return $this->belongsTo(Room::class,'room_id','id');
    }
}
