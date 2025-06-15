<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions; // Import this class

class Restaurant extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $guarded = [];


    use SoftDeletes;


    protected $dates = ['deleted_at'];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function restorrantayment(){
        return $this->hasMany(RestorantPayment::class,'restaurant_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getLogoAttribute($value)
    {
        return $value ? asset('public/images/restaurants/' . $value) : null;
    }

    public function hasAbility($permissions)
    {



        return true;

    }
}
