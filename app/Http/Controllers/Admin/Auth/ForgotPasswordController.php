<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{


    use SendsPasswordResetEmails;


    public function showLinkRequestForm(){
        return view('front.auth.forget_password');
    }
    public function sendResetLinkEmail(Request $request)
    {

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {

            return response_web(true,__('تفقد البريد الكتروني الخاص بك'),[],201);
        }
        return response_web(false,__('لم يتم ارسال كود التخقق '),[],500);

        // return response()->json(['message' => 'Unable to send password reset link.'], 500);
    }

}
