<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function workSpaces(){
        return $this->belongsTo(WorkSpace::class,'work_space_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function deskMangments(){
        return $this->hasMany(DeskMangment::class,'room_id','id');
    }

    public function userRooms(){
        return $this->hasMany(UserRoom::class,'room_id','id');
    }
}
