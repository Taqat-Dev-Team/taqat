<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function order()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeActive($q){
        return $q->where('is_active',1);
    }



}
