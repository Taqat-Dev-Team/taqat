<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogWhatsappClick extends Model
{
    use HasFactory;
    protected $table = 'users_logs_whatsapp_click';

    protected $guarded=[];

}
