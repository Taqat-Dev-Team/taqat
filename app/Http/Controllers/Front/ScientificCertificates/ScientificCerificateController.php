<?php

namespace App\Http\Controllers\Front\ScientificCertificates;

use App\Http\Controllers\Controller;
use App\Models\ScientificCertificate;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;

class ScientificCerificateController extends Controller
{
    public function index()
    {

        return view('front.scientificCertificates.index');
    }

    public function getIndex(Request $request)
    {
        $serach=$request->search['value']??false;
        $data = ScientificCertificate::query()
        ->when($serach,function($q)use($serach){
            $q->where('title', 'like', '%'.$serach.'%');
        })

            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('title', function ($data) {
                return $data->title;
            })

            ->addColumn('specialization', function ($data) {
                return $data->specialization;
            })

            ->addColumn('country', function ($data) {
                return $data->country;
            })

            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.scientificCerificates.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->title . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        return view('front.scientificCertificates.add');
    }



    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }

            $titleLanguage = detectLanguage($request->title);
            $specializationLanguage = detectLanguage($request->specialization);
            $countryLanguage = detectLanguage($request->country);

            $universityLanguage = detectLanguage($request->university);
            $collegeLanguage = detectLanguage($request->collge);


            $title = ['ar' => '', 'en' => ''];
            $specialization = ['ar' => '', 'en' => ''];
            $country = ['ar' => '', 'en' => ''];
            $university = ['ar' => '', 'en' => ''];
            $college = ['ar' => '', 'en' => ''];


            if ($titleLanguage === 'ar') {
                $title['ar'] = $request->title;
                $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->title;
            }

            if ($specializationLanguage === 'ar') {
                $specialization['ar'] = $request->specialization;
                $specialization['en'] = GoogleTranslate::trans($request->specialization, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $specialization['ar'] = GoogleTranslate::trans($request->specialization, 'ar', 'en'); // Optionally set a default or empty value for English
                $specialization['en'] = $request->specialization;
            }

            if ($countryLanguage === 'ar') {
                $country['ar'] = $request->country;
                $country['en'] = GoogleTranslate::trans($request->country, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $country['ar'] = GoogleTranslate::trans($request->country, 'ar', 'en'); // Optionally set a default or empty value for English
                $country['en'] = $request->country;
            }

            if ($universityLanguage === 'ar') {
                $university['ar'] = $request->university;
                $university['en'] = GoogleTranslate::trans($request->university, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $university['ar'] = GoogleTranslate::trans($request->university, 'ar', 'en'); // Optionally set a default or empty value for English
                $university['en'] = $request->university;
            }


            if ($collegeLanguage === 'ar') {
                $college['ar'] = $request->college;
                $college['en'] = GoogleTranslate::trans($request->college, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $college['ar'] = GoogleTranslate::trans($request->college, 'ar', 'en'); // Optionally set a default or empty value for English
                $college['en'] = $request->college;
            }

            ScientificCertificate::query()->create([
                'title' => $title,
                'user_id' => auth()->id(),
                'country' => $country,
                'specialization' => $specialization,
                'university' => $university,
                'college' => $college,
                'graduation_year' => $request->graduation_year,
                    'photo' =>  url('/').'/public/files/'.$photo,
            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {

        $data['scientific_certificate'] = ScientificCertificate::query()->where('id', $id)->where('user_id', auth()->id())->first() ?? abort(404);
        return view('front.scientificCertificates.edit', $data);
    }

    public function  update(Request $request)
    {
        try {
            $scientific_certificate = ScientificCertificate::query()->findorfail($request->scientific_certificate_id);
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                $scientific_certificate->update([
                    'photo' => $photo,
                ]);
            }

            $titleLanguage = detectLanguage($request->title);
            $specializationLanguage = detectLanguage($request->specialization);
            $countryLanguage = detectLanguage($request->country);

            $universityLanguage = detectLanguage($request->university);
            $collegeLanguage = detectLanguage($request->collge);


            $title = ['ar' => '', 'en' => ''];
            $specialization = ['ar' => '', 'en' => ''];
            $country = ['ar' => '', 'en' => ''];
            $university = ['ar' => '', 'en' => ''];
            $college = ['ar' => '', 'en' => ''];


            if ($titleLanguage === 'ar') {
                $title['ar'] = $request->title;
                $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->title;
            }

            if ($specializationLanguage === 'ar') {
                $specialization['ar'] = $request->specialization;
                $specialization['en'] = GoogleTranslate::trans($request->specialization, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $specialization['ar'] = GoogleTranslate::trans($request->specialization, 'ar', 'en'); // Optionally set a default or empty value for English
                $specialization['en'] = $request->specialization;
            }

            if ($countryLanguage === 'ar') {
                $country['ar'] = $request->country;
                $country['en'] = GoogleTranslate::trans($request->country, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $country['ar'] = GoogleTranslate::trans($request->country, 'ar', 'en'); // Optionally set a default or empty value for English
                $country['en'] = $request->country;
            }

            if ($universityLanguage === 'ar') {
                $university['ar'] = $request->university;
                $university['en'] = GoogleTranslate::trans($request->university, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $university['ar'] = GoogleTranslate::trans($request->university, 'ar', 'en'); // Optionally set a default or empty value for English
                $university['en'] = $request->university;
            }


            if ($collegeLanguage === 'ar') {
                $college['ar'] = $request->college;
                $college['en'] = GoogleTranslate::trans($request->college, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $college['ar'] = GoogleTranslate::trans($request->college, 'ar', 'en'); // Optionally set a default or empty value for English
                $college['en'] = $request->college;
            }


            $scientific_certificate->update([
                'title' => $title,
                'country' => $country,
                'specialization' => $specialization,
                'university' => $university,
                'college' => $college,
                'graduation_year' => $request->graduation_year,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        ScientificCertificate::query()->where('id', $request->id)->delete();

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
