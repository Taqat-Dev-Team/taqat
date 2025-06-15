<?php
/**
 * Created by PhpStorm.
 * User: Al
 * Date: 13/6/2020
 * Time: 06:30 م
 */

namespace App\Services;

use App\Models\Gallery;
use App\Models\GalleryType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileService
{


    public function __construct()
    {
    }

    public function storeFile($file, $folder, $model, $attr, $add)
    {


        if ($file instanceof UploadedFile) {
            return $this->storeLocal($file, $folder);
        } else if (is_numeric($file)) {
            return optional(Gallery::find($file))->getRawOriginal('src');
        } else {
            if (!$add && $model instanceof Model) {
                return $model->getRawOriginal($attr);
            } else {
                return getPath($folder, false);
            }
        }

    }
    public function storeFileId($file, $model, $attr, $add)
    {
        if ($file instanceof UploadedFile) {

            $path = $this->storeLocal($file, "galleries");
            $gallery_type = GalleryType::where('key' , '=' , $model->getTable())->first();

            $gallery = Gallery::create([
                'name' => ['ar' => $file->getClientOriginalName()],
                'type_id' => $gallery_type ? $gallery_type->id : 1,
                'show_in_gallery' => 0,
                'src' => $path,
                'size' => File::size(getUploadsPath($path)),
                'mime_type' => File::mimeType(getUploadsPath($path))
            ]);

            return $gallery->id;
        } else if (is_numeric($file)) {
            return $file;
        } else {
            if (!$add && $model instanceof Model) {
                return $model->getRawOriginal($attr);
            } else {
                return null;
            }
        }
    }
    public function storeLocal($file, $folder , $other_image_file = false)
    {

        $ext = $file->getClientOriginalExtension();
        $folder_path = $folder."/".Carbon::now()->format('Y-m-d');
        $thumb_path = getUploadsThumbPath($folder_path);

        $file_name = Str::random(20) . time() . Str::random(20) . "." . $ext;
        $stored_path = $file->storeAs( $folder_path, $file_name);
//        if(!$other_image_file) {
//
//            if(!File::exists($thumb_path)) {
//                File::makeDirectory($thumb_path , 0777);
//            }
//            Image::make(getUploadsPath($stored_path))->resize(300 , 300)
//                ->save($thumb_path."/".$file_name);
//        }
        return $stored_path;
    }


    public function getImageData($path) {
        $image = Image::make(getUploadsPath($path));
        return [
            'size' => $image->filesize() ,
            'mime_type' => $image->mime()
        ];
    }
}