<?php

namespace App\Http\Controllers\Front\Jobs;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\Specialization;
use App\Notifications\ApplyOfferToJobNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{

    public function index(){

        $data['jobs']=Job::query()->orderby('id','desc')
         ->paginate(10);
         foreach ($data['jobs'] as $item) {
            $item->short_description = getMaxWords($item->description, 40);
        }

         return view('front.jobs.index',$data);
        }

        public function  view($id){
            $data['specializations'] = Specialization::get();
            $data['job_count'] = Job::query()->where('company_id', auth('company')->id())->count();
            $data['job'] = Job::query()->with(['applyJobs'])->where('id', $id)->first() ?? abort(404);


            return view('front.jobs.view',$data);
        }

        public function store(Request $request){

            $job=Job::query()->where('id',$request->job_id)->first()??abort(404);
           $apply_job= ApplyJob::query()->create([
                'user_id'=>auth()->id(),
                'description'=>$request->description,
                'job_id'=>$request->job_id,
            ]);
            Notification::send($job->Company, new ApplyOfferToJobNotification($apply_job));

            // Notification::send($job->Company,)
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);

        }
}
