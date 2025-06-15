<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }



    public function getAttachment(){

        if($this->photo){
            return asset('public/files/'.$this->photo);

        }else{
          return asset('assets/default.png');
        }
    }

    // public function
    public function getStatus(){
        if($this->status==1)
        {
            return '<span class="badge badge-danger">Pending</span>';
        }elseif($this->status==2) {
            return '<span class="badge badge-success">Payment</span>';

        }elseif($this->status==3)  {
            return '<span class="badge badge-info">reject</span>';

        }
    }


}
