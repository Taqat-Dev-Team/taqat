<?php

namespace App\Http\Controllers\Companies\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\Products\ProjectRequest;
use App\Mail\ZoomInvitationMail;
use App\Models\AttachmentProjectCompany;
use App\Models\Company;
use App\Models\CompanyProject;
use App\Models\Job;
use App\Models\JobInterView;
use App\Models\MyStone;
use Illuminate\Support\Facades\Queue;

use App\Models\Offer;
use App\Models\Project;
use App\Models\ProjectReview;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserProjectRatting;
use App\Notifications\newProjectNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; // Ensure this is imported for slug generation
use Jubaer\Zoom\Facades\Zoom;

class ProjectController extends Controller
{


    public function index($slug = null)
    {
        $statusMap = [
            'pennding' => 1,
            'processing' => 2,
            'completed' => 3,
            'reject' => 4,
            'ratting' => [3, 'hasRatting'],
            'not-ratting' => [3, 'noRatting']
        ];

        $status = $statusMap[$slug] ?? null;

        $query = CompanyProject::where('company_id', auth('company')->id());

        if (is_array($status)) {
            [$statusCode, $type] = $status;
            $query->where('status', $statusCode);
            $type === 'hasRatting' ? $query->whereHas('compnayRatting') : $query->doesntHave('compnayRatting');
        } elseif ($status !== null) {
            $query->where('status', $status);
        }

        $data['project_count'] = $query->count();
        $data['projects'] = $query->orderBy('created_at', 'desc')->paginate(10);

        foreach ($data['projects'] as $item) {
            $item->short_description = getMaxWords($item->description, 40);
        }

        return view('companies.projects.index', $data);
    }

    public function saveProjectImages(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = upload($file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function create()
    {
        return view('companies.projects.add', [
            'project_count' => CompanyProject::where('company_id', auth('company')->id())->count(),
            'specializations' => Specialization::all()
        ]);
    }

    public function show($id)
    {
        $project = CompanyProject::where('id', $id)
            ->where('company_id', auth('company')->id())
            ->firstOrFail();

        return view('companies.projects.view', [
            'project_count' => CompanyProject::where('company_id', auth('company')->id())->count(),
            'project' => $project,
            'ratings' => UserProjectRatting::where('project_id', $id)->first()
        ]);
    }

    public function store(ProjectRequest $request)
    {
        try {
            DB::beginTransaction();

            $projectData = $this->translateProjectData($request);
            $project = CompanyProject::create([
                'title' => $projectData['title'],
                'company_id' => auth('company')->id(),
                'description' => $projectData['description'],
                'received_required' => $projectData['received_required'],
                'skills' => $request->skills,
                'slug' => $projectData['slug'],
                'expected_budget' => $request->expected_budget,
                'similar_example' => $request->similar_example,
                'status' => 1,
            ]);

            $project->specializations()->attach($request->specialization_id);

            if ($request->document) {
                foreach ($request->document as $value) {
                    AttachmentProjectCompany::create([
                        'project_company_id' => $project->id,
                        'attachment' => $value,
                    ]);
                }
            }
            $users = User::query()->whereIn('specialization_id', [$request->specialization_id])->get();
            // $users = User::query()->where('id',1)->get();
//            $users->chunk(50)->each(function ($chunk) use ($project) {
//                Queue::push(new \App\Jobs\SendProjectNotificationJob($chunk, $project));
//            });

            DB::commit();

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            DB::rollBack();

            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function edit($id)
    {
        return view('companies.projects.edit', [
            'project_count' => CompanyProject::where('company_id', auth('company')->id())->count(),
            'specializations' => Specialization::all(),
            'project' => CompanyProject::where('id', $id)
                ->where('company_id', auth('company')->id())
                ->firstOrFail()
        ]);
    }

    public function update(ProjectRequest $request)
    {
        try {
            $project = CompanyProject::findOrFail($request->project_id);

            $projectData = $this->translateProjectData($request);

            if ($request->status == 3 && is_null($project->user_id)) {
                return response_web(false, 'لا يمكن تسليم المشروع بدون منفد للمشروع', [], 422);
            }

            $project->update([
                'title' => $projectData['title'],
                'description' => $projectData['description'],
                'slug' => $projectData['slug'],

                'received_required' => $projectData['received_required'],
                'skills' => $request->skills,
                'expected_budget' => $request->expected_budget,
                'similar_example' => $request->similar_example,
                'status' => $request->status,
            ]);

            $project->specializations()->sync($request->specialization_id);

            if ($request->document) {
                foreach ($request->document as $value) {
                    AttachmentProjectCompany::create([
                        'project_company_id' => $project->id,
                        'attachment' => $value,
                    ]);
                }
            }

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            // Log the exception
            Log::error($ex);
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function delete(Request $request)
    {
        CompanyProject::where('id', $request->id)->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }

    public function deleteProjectImages(Request $request)
    {
        AttachmentProjectCompany::where('id', $request->id)->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }

    public function acceptOffers(Request $request)
    {
        try {
            $offer = Offer::find($request->id);

            if ($offer) {
                $project = CompanyProject::find($offer->project_id);
                $project->update([
                    'user_id' => $offer->user_id,
                    'offer_id' => $offer->id,
                    'cost' => $offer->cost,
                    'status' => 2
                ]);

                Offer::where('project_id', $project->id)
                    ->where('user_id', $offer->user_id)
                    ->update(['status' => 2]);

                Offer::where('project_id', $project->id)
                    ->where('user_id', '!=', $offer->user_id)
                    ->update(['status' => 4]);

                return response_web(true, __('label.success_full_process'), [], 201);
            }

            return response_web(false, __('label.offer_not_found'), [], 404);
        } catch (\Exception $ex) {
            // Log the exception
            Log::error($ex);
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function submitRating(Request $request)
    {
        $request->validate([
            'professional_dealing' => 'required|integer|min:1|max:5',
            'communication_assistance' => 'required|integer|min:1|max:5',
            'quality_delivered_work' => 'required|integer|min:1|max:5',
            'experience_in_project_field' => 'required|integer|min:1|max:5',
            'delivery_on_time' => 'required|integer|min:1|max:5',
            'deal_with_again' => 'required|integer|min:1|max:5',
            'message' => 'required|string'
        ]);

        $project = CompanyProject::findOrFail($request->project_id);

        UserProjectRatting::updateOrCreate([
            'project_id' => $project->id,
            'user_id' => auth('company')->id(),
        ], [
            'professional_dealing' => $request->professional_dealing,
            'communication_assistance' => $request->communication_assistance,
            'quality_delivered_work' => $request->quality_delivered_work,
            'experience_in_project_field' => $request->experience_in_project_field,
            'delivery_on_time' => $request->delivery_on_time,
            'deal_with_again' => $request->deal_with_again,
            'message' => $request->message,
        ]);

        return response_web(true, __('label.success_full_process'), [], 201);
    }

    private function translateProjectData($request)
    {
        $descriptionLanguage = detectLanguage($request->description);
        $titleLanguage = detectLanguage($request->title);
        $received_requiredLanguage = detectLanguage($request->received_required);

        $slug = ['ar' => '', 'en' => ''];

        $description = ['ar' => '', 'en' => ''];
        $title = ['ar' => '', 'en' => ''];
        $received_required = ['ar' => '', 'en' => ''];

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


        if ($received_requiredLanguage === 'ar') {
            $received_required['ar'] = $request->received_required;
            $received_required['en'] = GoogleTranslate::trans($request->received_required, 'en', 'ar'); // Optionally set a default or empty value for English
        } else {
            $received_required['ar'] = GoogleTranslate::trans($request->received_required, 'ar', 'en'); // Optionally set a default or empty value for English
            $received_required['en'] = $request->received_required;
        }



        $slug['ar'] = slug($title['ar']);
        $slug['en'] = Str::slug($title['en']);

        // dd($slug);
        return [
            'title' => $title,
            'description' => $description,
            'received_required' => $received_required,
            'slug' => $slug
        ];
    }


    private function generateSlug($title)
    {
        return Str::slug($title);
    }

    public function Interview(Request $request)
    {
        try {

            $dateTimeString = $request->date . ' ' . $request->time; // Combining date and time inputs
            $dateTime = Carbon::parse($dateTimeString);

            $combined = $dateTime->format('Y-m-d h:i A');

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $time = $request->time;

            if ($request->project_id) {
                $project = Project::query()->find($request->project_id);
                $data['name'] = $project->title;
                $data['time'] = $combined;
            } else {
                $job = Job::query()->find($request->project_id);

                $data['name'] = $job->title;
                $data['time'] = $combined;
            }

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
                    'project_id' => $request->project_id
                ]);
                return response_web(true, __('label.success_full_process'), [], 201);
            } else {
                return response_web(false, __('label.not_create_zoom_meet'), [], 422);
            }
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    private function createMeet($data)
    {
        // dd();
        $meetings = Zoom::createMeeting([
            "agenda" => $data['name'],
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
}
