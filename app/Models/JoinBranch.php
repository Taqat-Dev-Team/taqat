<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinBranch extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function users(){
        return $this->belongsTo(User::class,'user_id','id');

    }

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');

    }
}
