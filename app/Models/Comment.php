<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id','id');
    }
    
}
