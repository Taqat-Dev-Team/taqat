<?php

namespace App\Http\Controllers\Companies\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Mail\ZoomInvitationMail;
use App\Models\Contracts;
use App\Models\Job;
use App\Models\JobInterView;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\JobCreatedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Jubaer\Zoom\Facades\Zoom;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; // Ensure this is imported for slug generation
use Illuminate\Support\Facades\Queue;

class JobController extends Controller
{


    public function index($slug = null)
    {
        $data['job_count'] = Job::query()->where('company_id', auth('company')->id())->count();

        $data['slug'] = $slug;
        return view('companies.jobs.index', $data);
    }



    public function getIndex(Request $request)
    {
        $slug = $request->slug;
        $search = $request->input('search.value'); // This retrieves the search value
        $data = Job::query();

        if ($search) {
            // Apply search filter to your query
            $data->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $data
            // $data = Job::query()
            // ->with('companies')
            ->where('company_id', auth('company')->id())
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

            ->addColumn('title_tag', function ($data) {
                return '<a href="' . route('companies.jobs.views', $data->id) . '">' . $data->title . '</a>';
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('apply_count', function ($data) {
                return $data->applyJobCount();
            })

            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })

            ->addColumn('action', function ($data) {
                $button = '';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';


                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a href="' . route('companies.jobs.edit', $data->id) . '"><span><i style="color:bule" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a  id="' . $data->id . '" name_delete="' . $data->title . '" class="delete "><span><i  style="color: red" class="fa fa-trash"></i></span></button>';


                return $button;
            })->rawColumns(['status', 'action', 'title_tag'])
            ->make(true);
    }


    public function show($id)
    {
        $data['specializations'] = Specialization::get();
        $data['job_count'] = Job::query()->where('company_id', auth('company')->id())->count();
        $data['job'] = Job::query()->with(['applyJobs'])->where('id', $id)->first() ?? abort(404);
        return view('companies.jobs.view', $data);
    }


    public function create()
    {
        $data['job_count'] = Job::query()->where('company_id', auth('company')->id())->count();
        $data['specializations'] = Specialization::query()->get();
        return view('companies.jobs.add', $data);
    }

    public function  store(JobRequest $request)
    {

        try {

            $translateJobData = $this->translateJobData($request);

          $job=Job::query()->create([
                'title' => $translateJobData['title'],
                'company_id' => auth('company')->id(),
                'description' => $translateJobData['description'],
                'job_requirements' => $translateJobData['job_requirements'],
                'slug' => $translateJobData['slug'],
                'skills' => $request->skills,
                'sallary' => $request->sallary,
                'specialization_id' => $request->specialization_id,
                'permanent_type' => $request->permanent_type,
                'duration' => $request->duration,


            ]);



            // $users = User::query()->where('id',1)->get();

            // $users->chunk(50)->each(function ($chunk) use ($job) {
            //     Queue::push(new \App\Jobs\SendJobNotificationJob($chunk, $job));
            // });



            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function edit($id)
    {
        $data['job_count'] = Job::query()
            ->where('company_id', auth('company')->id())->count();
        $data['specializations'] = Specialization::query()->get();

        $data['job'] = Job::query()->where('id', $id)->where('company_id', auth('company')->id())->first() ?? abort(404);
        return view('companies.jobs.edit', $data);
    }

    public function  update(JobRequest $request)
    {
        try {



            $translateJobData = $this->translateJobData($request);

            $job = Job::query()->findorfail($request->job_id);
            $job->update([
                'title' => $translateJobData['title'],
                'company_id' => auth('company')->id(),
                'description' => $translateJobData['description'],
                'job_requirements' => $translateJobData['job_requirements'],
                'slug' => $translateJobData['slug'],

                'skills' => $request->skills,
                'sallary' => $request->sallary,
                'specialization_id' => $request->specialization_id,
                'permanent_type' => $request->permanent_type,
                'duration' => $request->duration,
                'status' => $request->status,
            ]);
            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
    public function delete(Request $request)
    {
        Job::query()->where('id', $request->id)->delete();
        return response_web(true, __('label.success_full_process'), [], 201);
    }

    public function appetUsers(Request $request)
    {
        try {
            $attachment = null;
            if ($request->attachment) {
                $attachment = upload($request->attachment);
            }



            $contracts = Contracts::query()->where('user_id', $request->user_id)->where('job_id', $request->job_id)->first();

            if ($contracts) {
                return response_web(false, __('label.user_apply_to_contrancts'), [], 500);
            }

            User::query()->where('id', $request->user_id)->update([
                'company_id' => auth('company')->id(),
            ]);
            Contracts::query()->create([
                'user_id' => $request->user_id,
                'company_id' => auth('company')->id(),
                'job_id' => $request->job_id,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'requirements' => $request->requirements,
                'sallary' => $request->salary,
                'attachment' => $attachment,
                'specialization_id' => $request->specialization_id


            ]);


            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }




    public function Interview(Request $request)
    {
        try {

            $dateTimeString = $request->date . ' ' . $request->time; // Combining date and time inputs
            $dateTime = Carbon::parse($dateTimeString);

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $time = $request->time;
            $combined = $dateTime->format('Y-m-d h:i A');

            $job = Job::query()->find($request->job_id);
            $data['job_name'] = $job->title;
            $data['time'] = $combined;

            $url =  $this->createMeet($data);

            $user = User::query()->where('id', $request->user_id)->first();
            if ($url['data']['status']) {


                Mail::to($user->email)->send(new ZoomInvitationMail($url['data']['start_url'], $date, $time));


                JobInterView::query()->create([
                    'user_id' => $request->user_id,
                    'company_id' => auth('company')->id(),
                    'zoom_url' => $url['data']['start_url'],
                    'date' => Carbon::parse($request->date)->format('Y-m-d'),
                    'time' => Carbon::parse($request->time)->format('h:i'),
                    'job_id' => $request->job_id
                ]);
                return response_web(true, __('label.success_full_process'), [], 201);
            } else {
                return response_web(false, __('label.not_create_zoom_meet'), [], 422);
            }
        } catch (\Exception $ex) {
            return $ex;
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    private function createMeet($data)
    {
        // dd();
        $meetings = Zoom::createMeeting([
            "agenda" => $data['job_name'],
            "topic" => 'Taqat',
            "type" => 3, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => 60, // in minutes
            "timezone" => 'Asia/Dhaka', // set your timezone
            "password" => null,
            "start_time" => $data['time'], // set your start time
            "template_id" => 'Dv4YdINdTk+Z5RToadh5ug', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            "schedule_for" => 'hazem1fadil@gmail.com', // set your schedule for
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);

        return $meetings;
    }

    private function translateJobData($request)
    {
        $descriptionLanguage = detectLanguage($request->description);
        $titleLanguage = detectLanguage($request->title);
        $job_requirementsLanguage = detectLanguage($request->job_requirements);

        $slug = ['ar' => '', 'en' => ''];

        $description = ['ar' => '', 'en' => ''];
        $title = ['ar' => '', 'en' => ''];
        $job_requirements = ['ar' => '', 'en' => ''];

        if ($descriptionLanguage === 'ar') {
            $description['ar'] = $request->description;
            $description['en'] = GoogleTranslate::trans($request->description, 'en', 'ar'); // Optionally set a default or empty value for English
        } else {
            $description['ar'] = GoogleTranslate::trans($request->description, 'ar', 'en'); // Optionally set a default or empty value for English
            $description['en'] = $request->description;
        }

        if ($titleLanguage === 'ar') {
            $title['ar'] = $request->title;
            $title['en'] = GoogleTranslate::trans($request->title, 'en', 'ar'); // Optionally set a default or empty value for English
        } else {
            $title['ar'] = GoogleTranslate::trans($request->title, 'ar', 'en'); // Optionally set a default or empty value for English
            $title['en'] = $request->title;
        }


        if ($job_requirementsLanguage === 'ar') {
            $job_requirements['ar'] = $request->job_requirements;
            $job_requirements['en'] = GoogleTranslate::trans($request->job_requirements, 'en', 'ar'); // Optionally set a default or empty value for English
        } else {
            $job_requirements['ar'] = GoogleTranslate::trans($request->job_requirements, 'ar', 'en'); // Optionally set a default or empty value for English
            $job_requirements['en'] = $request->job_requirements;
        }




        $slug['ar'] = slug($title['ar']);
        $slug['en'] = Str::slug($title['en']);

        // dd($slug);
        return [
            'title' => $title,
            'description' => $description,
            'job_requirements' => $job_requirements,
            'slug' => $slug
        ];
    }
}
