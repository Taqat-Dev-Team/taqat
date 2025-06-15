<?php

namespace App\Http\Controllers\Companies\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('companies.profile.index');

    }

    public function UpdateProfile(Request $request)
    {

        $request->validate([
            'email' => ['required', Rule::unique('companies')->ignore(auth('company')->id()),],
            'name' => ['required', 'string', 'max:255',],
            'mobile' => ['required', Rule::unique('companies')->ignore(auth('company')->id()),]

        ]);
        try {

            auth('company')->user()->update([
'name'=>$request->name,
'email'=>$request->email,
'mobile'=>$request->mobile,
            ]);
                return response_web(true,'تم تنفيد العملية بنجاح',[],201);

        } catch (\Exception $exception) {
            return response_web(false,'هناك خطا ما يرجى المحاولة لاحقا',[],500);

        }
    }

    public function changePassword()
    {
        return view('companies.profile.change-password');

    }

    public function changePasswordProfile(Request $request)
    {
        try {

            $user = auth('company')->user();

            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return response_web(true,'تم تنفيد العملية بنجاح',[],201);

            }else{
                return response_web(false,'كلمة المرور الحالية غير صحيحة',[],422);

            }
            } catch (\Exception $exception) {


                return response_web(false,'هناك خطا ما يرجى المحاولة لاحقا',[],500);
            }
    }

}
