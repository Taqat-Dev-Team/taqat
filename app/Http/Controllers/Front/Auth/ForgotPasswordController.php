<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function showLinkRequestForm()
    {
        return view('front.auth.forget_password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',


        ]);


        $user = User::query()->where('email', $request->email)->first();

        if(!$user){
            return response_web(false, 'هذا الايميل غير موجود لدينا', [], 422);

        }
        if ($user->last_reset) {
            if ($user->last_reset == Carbon::today()->format('Y-m-d')) {
                return response_web(false, 'تم ارسال كلمة المرور الخاصة بك من قبل الرجاء متابعة الهاتف الخاص بك', [], 422);
            }
        }

        $mobile = $user->mobile;
        $lastThreeDigits = substr($mobile, -3);


        $password = rand(0, 9999999);

        $user->update([
            'last_reset' => Carbon::today(),
            'password' => Hash::make($password)
        ]);

        if (!$user->mobile) {
                return response_web(false, 'لا يوجد رقم جوال لهذا الحساب', [], 422);

        }
        $message = 'كلمة المرور الخاصة بك هي: ' . $password . "\n\nللحفاظ على حسابك، يرجى تغيير كلمة المرور بعد تسجيل الدخول.";
        $this->smsService->sendSMS($user->mobile, $message);

        return response_web(true, 'تم تنفيد العملية بنجاح', [
            'last_digit' => $lastThreeDigits,
        ], 201);
    }

    public function broker()
    {
        return Password::broker();
    }
}
