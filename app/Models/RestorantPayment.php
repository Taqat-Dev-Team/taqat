<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestorantPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }


    public function getPhoto(){
        return asset('public/storage/'.$this->photo);
    }

    public function restaurants(){
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }
}
