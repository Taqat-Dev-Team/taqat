<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadingGenerator extends Model
{
    use HasFactory;
    protected $guarded=[];
use SoftDeletes;
    public function generatorSubscriptions()
    {
        return $this->belongsTo(GeneratorSubscription::class,'generator_subscription_id','id');
    }
}
