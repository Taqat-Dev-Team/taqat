<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Survey::class, 'parent_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_surveys');
    }

}
