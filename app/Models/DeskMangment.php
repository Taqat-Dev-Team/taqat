<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskMangment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function workSpaces(){
        return $this->belongsTo(WorkSpace::class,'work_space_id','id');
    }

    public function rooms(){
        return $this->belongsTo(Room::class,'room_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function deskMangmentHistories(){
        return $this->hasMany(DeskMangmentHistory::class,'desk_mangment_id','id');
    }
    public function internetSubscription(){
        return $this->hasOne(SubscriptionInternet::class,'desk_mangment_id','id');
    }



}
