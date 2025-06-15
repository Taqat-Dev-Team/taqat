<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use HasFactory;

    protected $guarded=[];



    public function getPhoto(){
        return 'https://taqat-gaza.com/'.$this->image;
    }
}
