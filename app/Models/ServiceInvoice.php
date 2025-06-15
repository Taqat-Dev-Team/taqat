<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function userService(){
        return $this->belongsTo(UserService::class,'user_service_id','id');
    }
}
