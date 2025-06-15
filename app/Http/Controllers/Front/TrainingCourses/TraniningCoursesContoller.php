<?php

namespace App\Http\Controllers\Front\TrainingCourses;

use App\Http\Controllers\Controller;
use App\Models\TrainingCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Expectation;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;

class TraniningCoursesContoller extends Controller
{
    //

    public function index()
    {

        return view('front.trainingCourses.index');
    }

    public function getIndex(Request $request)
    {
        $serach = $request->search['value'] ?? false;

        // dd($serach);
        $data = TrainingCourse::query()
            ->when($serach, function ($q) use ($serach) {

                $q->where('title', 'like', '%'.$serach.'%');
            })
            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('title', function ($data) {


                return $data->title;
            })

            ->addColumn('location', function ($data) {


                return $data->location;
            })
            ->addColumn('specialty', function ($data) {


                return $data->specialty;
            })

            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.trainingCourses.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->title . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action', 'image', 'status'])
            ->make(true);
    }

    public function create()
    {

        return view('front.trainingCourses.add');
    }



    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }

            $titleLanguage = detectLanguage($request->title);
            $descriptionLanguage = detectLanguage($request->description);
            $locationLanguage = detectLanguage($request->location);
            $specialtyLanguage = detectLanguage($request->specialty);


            $title = ['ar' => '', 'en' => ''];
            $location = ['ar' => '', 'en' => ''];
            $description = ['ar' => '', 'en' => ''];
            $specialty = ['ar' => '', 'en' => ''];

            if ($titleLanguage === 'ar') {
                $title['ar'] = $request->title;
                $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->title;
            }

            if ($descriptionLanguage === 'ar') {
                $description['ar'] = $request->description;
                $description['en'] = GoogleTranslate::trans($request->description, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $description['ar'] = GoogleTranslate::trans($request->description, 'ar', 'en'); // Optionally set a default or empty value for English
                $description['en'] = $request->description;
            }

            if ($locationLanguage === 'ar') {
                $location['ar'] = $request->location;
                $location['en'] = GoogleTranslate::trans($request->location, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $location['ar'] = GoogleTranslate::trans($request->location, 'ar', 'en'); // Optionally set a default or empty value for English
                $location['en'] = $request->location;
            }


            if ($specialtyLanguage === 'ar') {
                $specialty['ar'] = $request->specialty;
                $specialty['en'] = GoogleTranslate::trans($request->specialty, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $specialty['ar'] = GoogleTranslate::trans($request->specialty, 'ar', 'en'); // Optionally set a default or empty value for English
                $specialty['en'] = $request->specialty;
            }
            TrainingCourse::query()->create([
                'title' => $title,
                'user_id' => auth()->id(),
                'location' => $location,
                'specialty' => $specialty,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
                'photo' => $photo,
                'description' => $description,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {

        $data['trainingCourse'] = TrainingCourse::query()->where('id', $id)->where('user_id', auth()->id())->first()??abort(404);
        return view('front.trainingCourses.edit', $data);
    }

    public function  update(Request $request)
    {
        try {
            $training_course = TrainingCourse::query()->findorfail($request->training_course_id);
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                $training_course->update([
                    'photo' => $photo,
                ]);
            }

            $titleLanguage = detectLanguage($request->title);
            $descriptionLanguage = detectLanguage($request->description);
            $locationLanguage = detectLanguage($request->location);
            $specialtyLanguage = detectLanguage($request->specialty);


            $title = ['ar' => '', 'en' => ''];
            $location = ['ar' => '', 'en' => ''];
            $description = ['ar' => '', 'en' => ''];
            $specialty = ['ar' => '', 'en' => ''];

            if ($titleLanguage === 'ar') {
                $title['ar'] = $request->title;
                $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->title;
            }

            if ($descriptionLanguage === 'ar') {
                $description['ar'] = $request->description;
                $description['en'] = GoogleTranslate::trans($request->description, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $description['ar'] = GoogleTranslate::trans($request->description, 'ar', 'en'); // Optionally set a default or empty value for English
                $description['en'] = $request->description;
            }

            if ($locationLanguage === 'ar') {
                $location['ar'] = $request->location;
                $location['en'] = GoogleTranslate::trans($request->location, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $location['ar'] = GoogleTranslate::trans($request->location, 'ar', 'en'); // Optionally set a default or empty value for English
                $location['en'] = $request->location;
            }


            if ($specialtyLanguage === 'ar') {
                $specialty['ar'] = $request->specialty;
                $specialty['en'] = GoogleTranslate::trans($request->specialty, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $specialty['ar'] = GoogleTranslate::trans($request->specialty, 'ar', 'en'); // Optionally set a default or empty value for English
                $specialty['en'] = $request->specialty;
            }

            $training_course->update([
                'title' => $title,
                'location' => $location,
                'description' => $description,
                'specialty' => $specialty,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        TrainingCourse::query()->where('id', $request->id)->delete();

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
