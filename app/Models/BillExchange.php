<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillExchange extends Model
{
        protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($billExchange) {
            // Generate the next receipt_number
            $maxNumber = self::max('receipt_number');
            $nextNumber = $maxNumber ? (int)$maxNumber + 1 : 1;

            if ($nextNumber > 999999) {
                throw new \Exception('Receipt number exceeds 999999');
            }

            $billExchange->receipt_number = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }

}
