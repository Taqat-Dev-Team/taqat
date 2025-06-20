<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getPhoto(){
        return asset('public/files/'.$this->photo);
    }
}
