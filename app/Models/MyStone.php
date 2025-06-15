<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyStone extends Model
{
    use HasFactory;

    protected $guarded=[];


    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function project(){
        return $this->belongsTo(CompanyProject::class,'project_id','id')->withTrashed();
    }



    public function getStatus(){

        // return $this->status();
        if($this->status==1)
        {
            return '<span class="badge badge-danger">Pending</span>';
        }elseif($this->status==2) {
            return '<span class="badge badge-success">Payment</span>';

        }elseif($this->status==3)  {
            return '<span class="badge badge-info">processing</span>';

        }

        elseif($this->status==5)  {
            return '<span class="badge badge-info">Reject</span>';

        }

        elseif($this->status==4)  {
            return '<span class="badge badge-primary">Completed</span>';

        }




}

public function ss(){

}
}
