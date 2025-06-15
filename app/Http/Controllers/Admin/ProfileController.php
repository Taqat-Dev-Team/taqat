<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');

    }

    public function UpdateProfile(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email:rfc,dns', Rule::unique('admins')->ignore(auth()->id()),],
            'name' => ['required', 'string', 'max:255',],
            'mobile' => ['required', Rule::unique('admins')->ignore(auth()->id()),]

        ]);
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->save();

            if($request->ILS_USD){
            $setting=Setting::query()->first();
            $setting->update([
                'ILS_USD'=>$request->ILS_USD,
            ]);
        }
            return response()->json(["status" => 201, "message" => 'تم تعديل الملف الشخصي بنجاح']);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => 'false',
                'errors' => $exception->getMessage(),
            ], 400);
        }
    }

    public function changePassword()
    {
        return view('admin.profile.change-password');

    }

    public function changePasswordProfile(Request $request)
    {
        try {

            $user = auth()->user();

            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return response()->json(["status" => 201, "message" => 'تم تنفيد العملية  بنجاح']);

            }else{
                return response()->json(["status" => 422, "message" => 'كلمة المرور الحالية غير صحيحة']);

            }
            } catch (\Exception $exception) {

                return response()->json([
                    'success' => 'false',
                    'errors' => $exception->getMessage(),
                ], 400);
            }
    }

}
