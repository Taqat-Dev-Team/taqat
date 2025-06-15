<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Services(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
    public function getStatus(){
        if($this->status==1)
        {
            return '<span class="badge badge-danger">'.__('label.active').'</span>';
        }else{
            return '<span class="badge badge-danger">'.__('label.expired').'</span>';

        }
    }

}
