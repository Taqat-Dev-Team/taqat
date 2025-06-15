<?php

namespace App\Http\Controllers\Restaurants\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurants\Auth\LoginRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
        public function getLogin()
    {
        return view('restaurants.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {

        try {



            $restaurant = Restaurant::query()->where('email', $request->email)->first();

            if (!$restaurant) {

                return response_api(false, __('هناك خطا في البيانات'), [], 422);
            }





            if (!Hash::check($request->password, $restaurant->password)) {
                return response_api(false, 'كلمة المرور غير صحيحة', [], 422);
            }




            Auth::guard('restaurant')->login($restaurant);
            return response_api(true, 'نجاح العملية', [], 201);
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
