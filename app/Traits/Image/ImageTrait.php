<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Image;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageTrait
{

//    public function get_image()
//    {
//        return $this->belongsTo(Gallery::class, 'image_id');
//    }

    public function getImageAttribute() {
        return is_null($this->image_id) ? getPath($this->getTable(), true) :$this->get_image->src; //set this to ->src
    }
    public function getImageArAttribute() {
        return is_null($this->image_ar_id) ? getPath($this->getTable(), true) :$this->get_image_ar->src ;
    }
    public $public_path = "";
//    public $storage_path = "";

    public function file( $file, $path, $width, $height ) : string
    {
         $this->public_path = "public/uploadedImages/".$path.'/';
         $this->storage_path = "/storage/uploadedImages/".$path.'/';




        if ( $file ) {

            $extension       = $file->getClientOriginalExtension();
            $file_name       = $path.'-'.Str::random(30).'.'.$extension;
            $url             = $file->storeAs($this->public_path,$file_name);
            $public_path     = public_path($this->public_path.$file_name);
            $img             = Image::make($public_path)->resize($width, $height);
            $url             = preg_replace( "/public/", "", $url );
            $url= str_replace("/uploadedImages/","",$url);
            $url= str_replace("//","/",$url);

            return $img->save($public_path) ? $url : '';
        }




    }

}
