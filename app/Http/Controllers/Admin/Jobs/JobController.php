<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Job;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;

class JobController extends Controller
{
    public function index($slug = null)
    {
        $data['slug'] = $slug;
        return view('admin.jobs.index', $data);
    }

    public function getIndex(Request $request)
    {
        $slug = $request->slug;
        $data = Job::query()
            ->when($slug == 'processing', function ($q) use ($slug) {
                $q->where('status', 2);
            })
            ->when($slug == 'completed', function ($q) use ($slug) {
                $q->where('status', 3);
            })
            ->when($slug == 'reject', function ($q) use ($slug) {
                $q->where('status', 4);
            })
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('apply_count', function ($data) {
                return $data->applyJobCount();
            })
            ->addColumn('company_name', function ($data) {
                return $data->company ? $data->company->name : '-';
            })
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })
            ->addColumn('action', function ($data) {
                $button = '';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                if(auth('admin')->user()->can('view_job_constrancts')){
                $button .= '<a href="' . route('admin.jobs.views', $data->id) . '"><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';

                }

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                if(auth('admin')->user()->can('edit_job_constrancts')){

                $button .= '<a href="' . route('admin.jobs.edit', $data->id) . '"><span><i style="color: blue" class="fas fa-edit"></i></span></a>';

                }
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                if(auth('admin')->user()->can('delete_job_constrancts')){

                $button .= '<a id="' . $data->id . '" name_delete="' . $data->title . '" class="delete"><span><i style="color: red" class="fa fa-trash"></i></span></a>';
                }
                return $button;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['job'] = Job::query()->with(['applyJobs'])->where('id', $id)->first() ?? abort(404);
        return view('admin.jobs.view', $data);
    }

    public function edit($id)
    {
        $data['specializations'] = Specialization::query()->get();
        $data['job'] = Job::query()->where('id', $id)->first() ?? abort(404);
        return view('admin.jobs.edit', $data);
    }

    public function update(JobRequest $request)
    {
        try {
            $descriptionLanguage = detectLanguage($request->description);
            $titleLanguage = detectLanguage($request->title);
            $jobRequirementsLanguage = detectLanguage($request->job_requirements);

            $description = ['ar' => '', 'en' => ''];
            $title = ['ar' => '', 'en' => ''];
            $job_requirements = ['ar' => '', 'en' => ''];

            if ($descriptionLanguage === 'ar') {
                $description['ar'] = $request->description;
                $description['en'] = GoogleTranslate::trans($request->description, 'en', 'ar');
            } else {
                $description['ar'] = GoogleTranslate::trans($request->description, 'ar', 'en');
                $description['en'] = $request->description;
            }

            if ($titleLanguage === 'ar') {
                $title['ar'] = $request->title;
                $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar');
            } else {
                $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en');
                $title['en'] = $request->title;
            }

            if ($jobRequirementsLanguage === 'ar') {
                $job_requirements['ar'] = $request->job_requirements;
                $job_requirements['en'] = GoogleTranslate::trans($request->job_requirements, 'en', 'ar');
            } else {
                $job_requirements['ar'] = GoogleTranslate::trans($request->job_requirements, 'ar', 'en');
                $job_requirements['en'] = $request->job_requirements;
            }

            $job = Job::query()->findOrFail($request->job_id);
            $job->update([
                'title' => $title,
                'description' => $description,
                'job_requirements' => $job_requirements,
                'skills' => $request->skills,
                'sallary' => $request->sallary,
                'specialization_id' => $request->specialization_id,
                'permanent_type' => $request->permanent_type,
                'duration' => $request->duration,
                'status' => $request->status,
            ]);

            activity()
                ->performedOn($job)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Job updated');

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $job = Job::query()->findOrFail($request->id);
            $job->delete();

            activity()
                ->performedOn($job)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Job deleted');

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
}

