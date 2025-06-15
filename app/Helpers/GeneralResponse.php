<?php
use Intervention\Image\Facades\Image as Image;

function generalResponse($status , $message , $data , $status_code = 200) {
    $data = [
        'status' => $status ,
        'message' => $message ,
        'data' => $data ,
    ];
    return $data;
}
function responseJson($status , $message , $data , $status_code = 200) {
    return response()->json(generalResponse($status , $message , $data , $status_code) , $status_code);
}
 function generate_code(){
    $digits = 6;
    return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
}


 function upload($file)
{
    $filename = uniqid() . '_' . time();

    if ($file->isFile() && $file->getClientOriginalExtension() === 'pdf') {
        // Handle PDF files
        $path = $filename . '.pdf';
        $file->move(public_path('files'), $path);
    } else {
        // Handle image files
        $image = Image::make($file);

        // Resize image while maintaining aspect ratio
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Encode the image to reduce file size if necessary
        $image->encode('jpg', 75); // You can adjust the quality (75) to achieve a smaller file size

        // Check if the image size is still larger than 1MB
        if (strlen((string) $image) > 1048576) {
            // Further reduce the quality to meet the 1MB limit
            $image->encode('jpg', 50);
        }

        $path = $filename . '.jpg';
        $image->save(public_path('files/' . $path));
    }

    return $path;
}

function get_order_number()
{
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $unique = $rand;
    return $unique;
}


function get_users_number()
{
    $today = mt_rand(0, 150);
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $unique = $today.$rand;
    return $unique;
}


