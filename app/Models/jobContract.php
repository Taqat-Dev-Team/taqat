<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobContract extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getAttachment()
    {
    //     $attachments = $this->photo;
    //     $extension = pathinfo($attachments, PATHINFO_EXTENSION);

    //     $attachment = '';
    //     if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
    //         $attachment .= '<a href="' . $attachments . '" target="_blank">

    //         <img src="' . $attachments . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt=""></a>';
    //     } else if (in_array($extension, ['pdf'])) {
    //         $attachment .= '<a href="' . $attachments . '" target="_blank">
    //     <i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius: 50%;font-size: 70px; color: red;"></i>
    // </a>';
    //     } else {

    //         $attachment .= '<img src="' . asset('assets/default.png') . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">';
    //     }
        // return $attachment;



        return $this->photo ?             asset($this->photo) : asset('assets/default.png');
    }
}
