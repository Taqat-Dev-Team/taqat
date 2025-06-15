<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionInternet extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function deskMangments(){
        return $this->belongsTo(DeskMangment::class,'desk_mangment_id','id');
    }

    public function subscriptionType(){
        return $this->belongsTo(SubscriptionType::class,'subscription_type_id','id');
    }
    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }



    public function getStatus()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-success">' . __('label.active') . '</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-secondary">'  . __('label.pendding') . '</span>';
        }
        elseif ($this->status == 3) {
            return '<span class="badge badge-info">'  . __('label.available') . '</span>';
        }
        elseif ($this->status == 4) {
            return '<span class="badge badge-warning">'  . __('label.delete_subscription') . '</span>';
        }
        else {
            return '<span class="badge badge-danger">' . __('label.expired') . '</span>';
        }
    }


}
