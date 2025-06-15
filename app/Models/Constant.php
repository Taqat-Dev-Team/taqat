<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constant extends Model
{
    use HasFactory;

    protected $table = 'constants'; // تأكد أن هذا الاسم مطابق لاسم الجدول في قاعدة البيانات
    protected $fillable = ['category', 'key', 'value','value_en', 'is_mange'];
}
