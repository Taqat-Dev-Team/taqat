<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInterView extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jobs()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }


    public function projects(){
        return $this->belongsTo(Project::class, 'project_id', 'id');

    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
