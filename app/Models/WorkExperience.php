<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WorkExperience extends Model
{
    use HasFactory;
    protected $guarded=[];
    use HasTranslations;

    public $translatable = ['company_name','tasks','job','location'];

    public function getPhoto(){

        if($this->photo){
            return asset('public/files/'.$this->photo);

        }else{
          return asset('assets/default.png');
        }
    }
}
