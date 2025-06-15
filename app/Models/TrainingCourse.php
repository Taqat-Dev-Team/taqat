<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TrainingCourse extends Model
{
    use HasFactory;
    protected $guarded=[];
    use HasTranslations;

    public $translatable = ['title','description','location','specialty'];

    public function getPhoto(){

        if($this->photo){
            return asset('public/files/'.$this->photo);

        }else{
          return asset('assets/default.png');
        }
    }
}
