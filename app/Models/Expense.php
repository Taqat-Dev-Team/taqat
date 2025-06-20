<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function paymentTypes(){
        return $this->belongsTo(Account::class,'payment_method_id','id');

    }
}
