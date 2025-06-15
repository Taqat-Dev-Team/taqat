<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function formAccount(){
        return $this->belongsTo(Account::class,'form_account_id');
    }
    public function toAccount(){
        return $this->belongsTo(Account::class,'to_account_id');
    }

    public function balanceTypes(){
        return $this->belongsTo(Constant::class,'balance_type_id','id');
    }

}
