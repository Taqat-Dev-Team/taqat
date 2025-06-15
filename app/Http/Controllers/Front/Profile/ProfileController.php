<?php

namespace App\Http\Controllers\Front\Profile;





use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Profile\ProfileRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $data['specializations'] = Specialization::get();
        return view('front.profile.index', $data);
    }

    public function UpdateProfile(ProfileRequest $request)
    {

        try {
            $detectLanguage = detectLanguage($request->name);

            $slug = '';

            if ($detectLanguage == 'ar') {
                $slug = slug($request->name);
            } else {
                $slug = Str::slug($request->name);
            }
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                auth()->user()->update([
                    'photo' => url('/') . '/public/files/' . $photo,
                ]);
            }
            $user = auth()->user()->update([
                'bio' => $request->bio,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'whatsapp' => $request->whatsapp,
                'sallary' => $request->sallary,
                'company_id' => $request->company_id,
                'marital_status' => $request->marital_status,
                'displacement_place' => $request->displacement_place,
                'original_place' => $request->original_place,
                'skills' => $request->skills,
                'specialization_id' => $request->specialization_id,
                'slug' => $slug,

                'workplace_attendance' => $request->workplace_attendance

            ]);

            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return $exception;

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


    public function personalData()
    {
        return view('front.profile.personal-data');
    }
    public function updatePersonalData(Request $request)
    {
        try {
            $user = auth()->user();
            $user->update([
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'third_name' => $request->third_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'id_number' => $request->id_number,
                'full_name' => $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->last_name,
                'is_verification' => 2,
            ]);

            if ($request->hasFile('photo')) {

                $photo = $request->file('photo')->store('profile_photos', 'public');
                $user->update([
                    'id_photo' => $photo,
                ]);
            }





            return response_web(true, 'تم تحديث البيانات الشخصية بنجاح', [], 200);
        } catch (\Exception $exception) {
            return $exception;
            return response_web(false, 'هناك خطأ ما يرجى المحاولة لاحقاً', [], 500);
        }
    }
}
