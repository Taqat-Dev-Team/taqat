<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $guarded=[];

    use SoftDeletes;



    public function users(){
        return $this->hasOne(User::class,'company_id','id');
    }

    public function chats(){
        return $this->hasMany(Chat::class,'company_id','id');
    }

    public function getPhoto(){

        // if($this->photo){
        //     return asset($this->photo);

        // }else{
        //   return asset('assets/default.png');
        // }

        if ($this->photo) {
            // Check if the photo URL contains 'public/files'
            if (strpos($this->photo, 'public/files') !== false) {
                return asset($this->photo);
            } else {
                // If it does not contain 'public/files', return a default URL or handle it accordingly
                return asset('public/files/'.$this->photo); // Adjust the default photo location if necessary
            }
        } else {
            return asset('assets/default.png');
        }

    }

    public function userCount(){
        return $this->users()->count();
    }
}
