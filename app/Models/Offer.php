<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function project(){
        return $this->belongsTo(CompanyProject::class,'project_id','id');
    }

}
