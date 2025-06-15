<?php

use App\Models\Country;
use Illuminate\Support\Facades\Auth;

function getPath($folder, $full_path = true, $default_image = "default.png")
{
    return $full_path ? ($folder != '' ? url("uploads/$folder/$default_image") : url("uploads/$default_image")) : "$folder/" . $default_image;
}

function getMultiLangField($default_value = '')
{
    $data = [];
    foreach (config('app.locales') as $locale) {
        $data[$locale] = $default_value;
    }
    return $data;
}
   function logActivity(string $message, $subject): void
    {
        activity()
            ->performedOn($subject)
            ->causedBy(auth('admin')->user())
            ->log($message);
    }

function getStatusButton($status, $id)
{
    $checked = $status ? 'checked="checked"' : '';
    return '<span class="switch switch-icon">
                <label>
                    <input type="checkbox" ' . $checked . ' name="status" data-id="' . $id . '" data-status="' . $status . '" class="check_status" />
                    <span></span>
                </label>
            </span>';
}
function checkCanFilter($attribute)
{
    return !is_null($attribute) && $attribute != -1;
}

// check role
function checkAdminRole($role)
{
    $admin = Auth::guard('admin')->user();
    if ($admin->is_super == 1) return true;
    return $admin->hasPermissions($role);
}

function returnData($key, $value, $num = 200, $msg = "")
{
    return response()->json([
        'status' => true,
        'statusNumber' => $num,
        'msg' => $msg,
        $key => $value
    ]);
}

function response_api($status, $message, $data, $status_code = 200)
{
    $response = [];
    $response['status'] = $status;
    $status_code_ = !$status && $status_code == 200 ? 422 : $status_code;
    $response['code'] = $status_code_;
    $response['message'] = $message;
//    if ($status) {
    $response = $response + $data;
//    }


    return response()->json($response, $status_code_);

}

function response_web($status, $message, $data, $status_code = 200)
{
    $response = [];
    $response['status'] = $status;
    $status_code_ = !$status && $status_code == 200 ? 422 : $status_code;
    $response['code'] = $status_code_;
    $response['message'] = $message;
//    if ($status) {
    $response = $response + $data;
//    }


    return response()->json($response, $status_code_);

}

function detectLanguage($input) {
    // Check for Arabic characters
    if (preg_match('/[\x{0600}-\x{06FF}]/u', $input)) {
        return 'ar'; // Arabic
    }

    // Check for English characters
    if (preg_match('/[a-zA-Z]/', $input)) {
        return 'en'; // English
    }

    // Default or unknown
    return 'unknown';
}

 function slug($string, $separator = '-') {
    if (is_null($string)) {
        return "";
    }

    $string = trim($string);

    $string = mb_strtolower($string, "UTF-8");;

    $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    $string = preg_replace("/[\s-]+/", " ", $string);

    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}








