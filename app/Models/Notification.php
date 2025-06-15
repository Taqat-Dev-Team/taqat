<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function projects(){
        return $this->belongsTo(CompanyProject::class,'project_id','id')->withTrashed();
    }
    public function jobs(){
        return $this->belongsTo(Job::class,'job_id','id')->withTrashed();
    }
}


