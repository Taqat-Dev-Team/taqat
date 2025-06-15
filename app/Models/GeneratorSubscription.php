<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GeneratorSubscription extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;


    public function readingGenerator()
    {
        return $this->hasMany(ReadingGenerator::class, 'generator_subscription_id', 'id');
    }
    public function generatorReceipt()
    {
        return $this->hasMany(GeneratorReceipt::class, 'generator_subscription_id', 'id');
    }

    public function generator()
    {
        return $this->belongsTo(Generator::class, 'generator_id', 'id');
    }

    public  function  getPhoto(){
        if (!$this->photo){
            return asset('assets/media/avatars/300-1.jpg');
        }

        return  asset('storage/'.$this->photo);
    }

}
