<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

      public function restaurants(){
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }


    public function orderDetails(){
                return $this->hasMany(OrderDetail::class,'order_id','id');

    }
   public function getStatus()
    {

        // 1return $this->status();
        switch ($this->status_cd_id) {
            case 0:
            return '<span class="badge badge-danger">جديد</span>';
            case 1:
            return '<span class="badge badge-success">مكتمل</span>';
            case 2:
            return '<span class="badge badge-warning">قيد التنفيد</span>';
            case 3:
            return '<span class="badge badge-secondary">ملغي</span>';
            default:
            return '<span class="badge badge-light">غير معروف</span>';
        }
    }

}
