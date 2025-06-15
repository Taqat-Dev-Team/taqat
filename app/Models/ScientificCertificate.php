<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ScientificCertificate extends Model
{
    use HasFactory;
    protected $guarded=[];



    use HasTranslations;

    public $translatable = ['title','university','country','specialization','college'];

    function hasPublicFiles($url) {
        // Check if 'public/files' is in the URL
        if (strpos($url, 'public/files') !== false) {
            return true;
        } else {
            return false;
        }
    }

    // Ex
    public function getPhoto(){

        // if($this->photo){
        //     return asset($this->photo);

        // }else{
        //   return asset('assets/default.png');
        // }

        if ($this->photo) {
            // Check if the photo URL contains 'public/files'
            if (strpos($this->photo, 'public/files') !== false) {
                return asset($this->photo);
            } else {
                // If it does not contain 'public/files', return a default URL or handle it accordingly
                return asset('public/files/'.$this->photo); // Adjust the default photo location if necessary
            }
        } else {
            return asset('assets/default.png');
        }

    }
}
