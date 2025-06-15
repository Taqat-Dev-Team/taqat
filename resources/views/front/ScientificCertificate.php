<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScientificCertificate extends Model
{
    use HasFactory;
    protected $guarded=[];




    public function getPhoto(){

        if($this->photo){
            return asset('public/files/'.$this->photo);

        }else{
          return asset('assets/default.png');
        }
    }
}
