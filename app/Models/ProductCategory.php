<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function parentCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_category_id');
    }

    // Scope a query to only include active categories.
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getImageUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/default.png');
    }

}
