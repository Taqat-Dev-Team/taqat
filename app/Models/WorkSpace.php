<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSpace extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function deskMangments(){
        return $this->hasMany(DeskMangment::class,'work_space_id','id');
    }

    public function rooms(){
        return $this->hasMany(Room::class,'work_space_id','id');
    }

}
