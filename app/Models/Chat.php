<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function projects(){
        return $this->belongsTo(CompanyProject::class,'project_id','id')->withTrashed();

    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();


    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id')->withTrashed();


    }

    public function comments(){
        return $this->hasMany(Comment::class,'chat_id','id');
    }
    public function jobs(){
        return $this->belongsTo(Job::class,'job_id','id')->withTrashed();


    }

}
