<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory;

    protected $guarded=[];

    use HasTranslations;

    public $translatable = ['title','description'];

    public function getAttachment(){

        if($this->photo){
            return asset('public/files/'.$this->photo);

        }else{
          return asset('assets/default.png');
        }
    }

    public function specializations(){
        return $this->belongsTo(Specialization::class,'project_type','id');
    }
    public function images(){
        return $this->hasMany(ProjectImage::class,'project_id','id');
    }


    // protected $casts = [
    //     'title' => 'json',
    //     'description'=>'json',
    // ];

}
