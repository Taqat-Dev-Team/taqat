<?php

namespace App\Http\Controllers\Front\Profile;





use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('front.profile.index');
    }

    public function UpdateProfile(Request $request)
    {

        $request->validate([
            'email' => ['required', Rule::unique('users')->ignore(auth()->id()),],
            'name' => ['required', 'string', 'max:255',],
            'mobile' => ['required', Rule::unique('users')->ignore(auth()->id()),]

        ]);
        try {

            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                auth()->user()->update([
                    'photo' => $photo,
                ]);
            }
            $user = auth()->user()->update([
                'bio'=>$request->bio,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'whatsapp' => $request->whatsapp,
                'email' => $request->email,
                'job' => $request->job,
                'sallary' => $request->sallary,
                'company_id' => $request->company_id,
                'marital_status' => $request->marital_status,
                'displacement_place' => $request->displacement_place,
                'original_place' => $request->original_place,
                'skills'=>$request->skills,
            ]);

            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return response_web(false, 'هناك خطا ما يرجى المحاولة لاحقا', [], 500);
        }
    }

    public function changePassword()
    {
        return view('front.profile.change-password');
    }

    public function changePasswordProfile(Request $request)
    {
        try {

            $user = auth()->user();

            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
            } else {
                return response_web(false, 'كلمة المرور الحالية غير صحيحة', [], 422);
            }
        } catch (\Exception $exception) {


            return response_web(false, 'هناك خطا ما يرجى المحاولة لاحقا', [], 500);
        }
    }
}
