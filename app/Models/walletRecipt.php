<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walletRecipt extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getAttachment()
    {


        if ($this->photo) {

            return '<a href="' . asset('public/storage/' . $this->photo) . '">'
                . '<img src="' .  asset('public/storage/' . $this->photo) . '" class="circle" '
                . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                . '</a>';
        } else {
            return '<a href="' . asset('assets/default.png') . '">'
                . '<img src="' .   asset('assets/default.png') . '" class="circle" '
                . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                . '</a>';
        }
    }


    public function wallet()
    {
        return $this->belongsTo(wallet::class, 'wallet_id', 'id');
    }
    public function getStatus()
    {
        // dd($this->status_cd_id);

        if ($this->status_cd_id == 0) {
            return '<span class="badge badge-secondery"غير مدفوع</span>';
        }
        if ($this->status_cd_id == 1) {
            return '<span class="badge badge-success">تم الدفع</span>';
        } elseif ($this->status_cd_id == 2) {
            return '<span class="badge badge-warning">قيد الانتظار</span>';
        } elseif ($this->status_cd_id == 3) {
            return '<span class="badge badge-info">مرفوض</span>';
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
