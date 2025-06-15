<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\Attendance;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthContoller extends Controller
{
    public function getLogin()
    {


               return redirect()->away('https://taqat-gaza.com/ar/talent/login');

    }

    public function postLogin(Request $request)
    {
        $user_cred = $request->only('email', 'password');

        // Cookie::queue(Cookie::forget('taqat_session'));

        if (Auth::guard()->attempt($user_cred)) {
            $user = auth()->user();

            if ($user->status == 1||$user->status == 3) {
                $attendance = Attendance::query()
                    ->whereDate('date', now()->toDateString())
                    ->where('user_id', $user->id)
                    ->first();

                if (!$attendance) {
                    Attendance::query()->create([
                        'user_id' => $user->id,
                        'login_time' => Carbon::now(),
                        'date' => Carbon::today(),
                    ]);
                }
                session()->forget('user');

                session()->put(['user'=>$user]);

                $response['data']=null;
                return response_web(true,__('تم تسجيل الدخول بنجاح'),$response,201);
} else {
    $response['data']=null;

                Auth::guard()->logout();
                return response_web(false,__('الحساب مغلق حاليا يرجى مراجعة الادارة'),$response,422);

                // return redirect()->back()
                // ->withInput($request->only('email'))
                // ->withErrors(['email' => 'هذا الحساب مغلق مؤقتا يرجى المحاولة لاحقا']);

            }
        } else {
            $response['data']=null;

            return response_web(false,__('هناك خطا في البيانات المدخلة'),$response,422);

            // return redirect()->back()
            // ->withInput($request->only('email'))
            // ->withErrors(['email' => '']);
    }
    }



    public function getRegister(){

        $data['specializations']=Specialization::query()->get();
        return view('front.auth.register',$data);
    }

    public function postRegister(RegisterRequest $request){

        try {

            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

            }

            $detectLanguage = detectLanguage($request->name);

            $slug='';
            if ($detectLanguage == 'ar') {
                $slug = slug($request->name);
            } else {
                $slug = Str::slug($request->name);
            }
       $user=   User::query()->create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'whatsapp' => $request->whatsapp,
                'email' => $request->email,
                'job' => $request->job,
                'gender'=>$request->gender,
                // 'sallary' => $request->sallary,
                // 'company_id' => $request->company_id,
                // 'marital_status' => $request->marital_status,
                'displacement_place' => $request->displacement_place,
                'original_place' => $request->original_place,
                'password'=>Hash::make($request->password),
                'status'=>3,
                'slug'=>$slug,

                'photo'=>url('/').'/public/files/'.$photo,
            ]);

            session()->forget('user');

            session()->put(['user'=>$user]);
            Auth::login($user);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return response_web(false, 'هناك خطا ما يرجى المحاولة لاحقا', [], 500);
        }
    }

    public function forgetPassword(){

    }

 public function logout(Request $request)
    {

        auth()->logout();

        $teamUrl = "http://taqat-gaza.com/autologout";
        return redirect()->away($teamUrl) ->with(['message' => trans('main.logout_success'), 'alert-type' => 'success']);

    }
}
