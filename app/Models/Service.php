<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use \Currency;

class Service extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function currencyCd(){
        return $this->belongsTo(Constant::class,'currency_cd_id','id');
    }

}
