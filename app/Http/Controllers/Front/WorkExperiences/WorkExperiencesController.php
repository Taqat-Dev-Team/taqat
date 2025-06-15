<?php

namespace App\Http\Controllers\Front\WorkExperiences;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;

class WorkExperiencesController extends Controller
{
    public function index()
    {

        return view('front.workExperiences.index');
    }

    public function getIndex(Request $request)
    {
        $data = WorkExperience::query()->orderby('created_at', 'desc')
            ->where('user_id', auth()->id());

        return DataTables::of($data)
        ->addColumn('company_name', function ($data) {

          return  $data->company_name;
        })
            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.workExperiences.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->company_name . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action', 'image', 'status'])
            ->make(true);
    }

    public function create()
    {

        return view('front.workExperiences.add');
    }



    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }

            $company_nameLanguage = detectLanguage($request->company_name);
            $tasksLanguage = detectLanguage($request->tasks);
            $jobLanguage = detectLanguage($request->job);

            $title = ['ar' => '', 'en' => ''];
            $job = ['ar' => '', 'en' => ''];
            $tasks = ['ar' => '', 'en' => ''];

            if ($company_nameLanguage === 'ar') {
                $title['ar'] = $request->company_name;
                $title['en'] = GoogleTranslate::trans($request->company_name, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->company_name, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->company_name;
            }

            if ($tasksLanguage === 'ar') {
                $tasks['ar'] = $request->tasks;
                $tasks['en'] = GoogleTranslate::trans($request->tasks, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $tasks['ar'] = GoogleTranslate::trans($request->tasks, 'ar', 'en'); // Optionally set a default or empty value for English
                $tasks['en'] = $request->tasks;
            }

            if ($jobLanguage === 'ar') {
                $job['ar'] = $request->job;
                $job['en'] = GoogleTranslate::trans($request->job, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $job['ar'] = GoogleTranslate::trans($request->job, 'ar', 'en'); // Optionally set a default or empty value for English
                $job['en'] = $request->job;
            }

            WorkExperience::query()->create([
                'company_name' => $title,
                'user_id' => auth()->id(),
                'location' => $request->location,
                'job' => $job,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
                'photo' => $photo,
                'tasks' => $tasks,
            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {

            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {

        $data['workExperience'] = WorkExperience::findorfail($id);
        return view('front.workExperiences.edit', $data);
    }

    public function  update(Request $request)
    {
        try {
            $work_experiences = WorkExperience::findorfail($request->work_experience_id);
            $photo = "";

            $company_nameLanguage = detectLanguage($request->company_name);
            $tasksLanguage = detectLanguage($request->tasks);
            $jobLanguage = detectLanguage($request->job);
            $joblocation = detectLanguage($request->location);

            $title = ['ar' => '', 'en' => ''];
            $job = ['ar' => '', 'en' => ''];
            $tasks = ['ar' => '', 'en' => ''];
            $location = ['ar' => '', 'en' => ''];

            if ($company_nameLanguage === 'ar') {
                $title['ar'] = $request->company_name;
                $title['en'] = GoogleTranslate::trans($request->company_name, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $title['ar'] = GoogleTranslate::trans($request->company_name, 'ar', 'en'); // Optionally set a default or empty value for English
                $title['en'] = $request->company_name;
            }

            if ($joblocation === 'ar') {
                $location['ar'] = $request->location;
                $location['en'] = GoogleTranslate::trans($request->location, 'en', 'ar');; // Optionally set a default or empty value for English
            } else {
                $location['ar'] = GoogleTranslate::trans($request->location, 'ar', 'en'); // Optionally set a default or empty value for English
                $location['en'] = $request->location;
            }


            if ($tasksLanguage === 'ar') {
                $tasks['ar'] = $request->tasks;
                $tasks['en'] = GoogleTranslate::trans($request->tasks, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $tasks['ar'] = GoogleTranslate::trans($request->tasks, 'ar', 'en'); // Optionally set a default or empty value for English
                $tasks['en'] = $request->tasks;
            }

            if ($jobLanguage === 'ar') {
                $job['ar'] = $request->job;
                $job['en'] = GoogleTranslate::trans($request->job, 'en', 'ar'); // Optionally set a default or empty value for English
            } else {
                $job['ar'] = GoogleTranslate::trans($request->job, 'ar', 'en'); // Optionally set a default or empty value for English
                $job['en'] = $request->job;
            }


            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                $work_experiences->update([
                    'photo' => $photo,
                ]);
            }

            $work_experiences->update([
                'company_name' => $title,
                'user_id' => auth()->id(),
                'location' => $request->location,
                'job' => $job,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
                'tasks' => $tasks,
            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        WorkExperience::query()->where('id', $request->id)->delete();

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
