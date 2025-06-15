<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Generator extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;

    public function generatorSubscriptions()
    {
        return $this->hasMany(GeneratorSubscription::class, 'generator_id', 'id');
    }


    // علاقة بين المولد والدفعات
    // الوصول للدفعات من خلال المشتركين المرتبطين بالمولد
    public function generatorReceipts()
    {
        return $this->hasManyThrough(
            GeneratorReceipt::class,
            GeneratorSubscription::class,
            'generator_id',      // Foreign key on GeneratorSubscription table...
            'generator_subscription_id', // Foreign key on GeneratorReceipt table...
            'id',                // Local key on Generator table...
            'id'                 // Local key on GeneratorSubscription table...
        );
    }

    // اجمالي الدفعات
    public function getTotalReceiptsAttribute()
    {
        return $this->generatorReceipts()->sum('amount');
    }
     public function getSubscribeCountAttribute()
    {
        return $this->generatorSubscriptions()->count();
    }




    public function generatorExpenses()
    {
        return $this->hasMany(GeneratorExpense::class, 'generator_id', 'id');
    }
       public function getTotalExpensesAttribute()
    {
        return $this->generatorExpenses()->sum('total_amount');
    }

}
