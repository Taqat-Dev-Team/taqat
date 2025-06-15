<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Contracts\Activity;

class LoginController extends Controller
{


    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {

        try {



            $admin = Admin::query()->where('email', $request->email)->first();

            if (!$admin) {

                return response_api(false, __('هناك خطا في البيانات'), [], 422);
            }
            if (!$admin->status) {

                return response_api(false, __('الحساب مغلق مؤقتا يرجى مراجعة الادرة طاقات شكرا لك'), [], 422);
            }





            if (!Hash::check($request->password, $admin->password)) {
                return response_api(false, 'كلمة المرور غير صحيحة', [], 422);
            }




            Auth::guard('admin')->login($admin);
            $redirectUrl = route('admin.' . $admin->redirect_route);
            return response_api(true, 'نجاح العملية', ['redirect' => $redirectUrl], 201);
        } catch (\Exception $exception) {
            return $exception;
            return response_api(false, 'فشل العملية يرجى المحاولة لاحقا', [], 500);
        }

        // $admin_cred = $request->only('email', 'password');

        // if (Auth::guard('admin')->attempt($admin_cred)) {
        //     $admin = Auth::guard('admin')->user();

        //     if ($admin->status) {
        //         $url = $admin->role_id == 1 ? route('admin.home') : route('admin.attendances.index');

        //         // Log the login activity
        //         activity()->performedOn($admin)
        //             ->causedBy($admin)
        //             ->log('Admin logged in: ' . $admin->email);

        //         $response['data'] = $url;
        //         return response_web(true, __('تم تسجيل الدخول بنجاح'), $response, 201);
        //     } else {
        //         return response_web(false, __('تم حظرك مؤقتا الرجاء مراجعة الادارة'), [], 422);
        //     }
        // } else {
        //     return response_web(false, __('هناك خطا في البيانات المدخلة'), [], 422);
        // }
    }

    public function logout()
    {
        $admin = Auth::guard('admin')->user();

        // Log the logout activity
        activity()->performedOn($admin)
            ->causedBy($admin)
            ->log('Admin logged out: ' . $admin->email);

        Auth::logout();
        return redirect()->route('admin.login');
    }
}
