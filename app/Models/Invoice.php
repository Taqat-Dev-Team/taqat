<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function getPhoto()
    {


        if ($this->photo) {

            // If it does not contain 'public/files', return a default URL or handle it accordingly
            return $this->photo; // Adjust the default photo location if necessary

        } else {
            return asset('assets/default.png');
        }
    }

    public function getStatus()
    {

        // 1return $this->status();
        if (!$this->status) {
            return '<span class="badge badge-danger">غير مدفوع</span>';
        } elseif ($this->status == 1) {
            return '<span class="badge badge-success">تم الدفع</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-warning">قيد الانتظار</span>';
        } elseif ($this->status == 3) {
            return '<span class="badge badge-secondary">عدم الاستلام</span>';
        }
    }





    public function currencies()
    {
        return $this->belongsTo(Constant::class, 'amount_type', 'id');
    }
    public function invoiceService()
    {

        return $this->hasOne(ServiceInvoice::class, 'invocie_id', 'id');
    }
    public  function  users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
