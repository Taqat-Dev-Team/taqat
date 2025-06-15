<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracts extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $guarded=[];
    public function users(){

        return $this->belongsTo(User::class,'user_id','id');
    }


    public function specializations(){
        return $this->belongsTo(Specialization::class,'specialization_id','id');
    }


    
    public function getAttachment()
    {


        return $this->attachment ?             asset('/public/files/'.$this->attachment) : asset('assets/default.png');
    }

    public function company(){

        return $this->belongsTo(Company::class,'company_id','id');
    }
}
