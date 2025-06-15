<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskMangmentHistory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function deskMangment(){
        return $this->belongsTo(DeskMangment::class,'desk_mangment_id','id');
    }
}
