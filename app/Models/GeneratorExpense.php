<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratorExpense extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function generators()
    {

        return $this->belongsTo(Generator::class, 'generator_id', 'id');
    }
}
