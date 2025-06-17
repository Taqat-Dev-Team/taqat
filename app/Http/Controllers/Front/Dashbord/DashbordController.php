<?php

namespace App\Http\Controllers\Front\Dashbord;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\CompanyProject;
use App\Models\Constant;
use App\Models\Job;
use App\Models\JobInterView;
use App\Models\JoinBranch;
use App\Models\Offer;
use App\Models\Project;
use App\Models\User;
use App\Models\userSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    //

    public function index()
    {
        $data['jobs'] = Job::query()->wherehas('company')->orderby('id', 'desc')->where('status', 1)->take(5)->get();
        $data['projects'] = CompanyProject::query()->wherehas('company')->orderby('id', 'desc')->take(5)->get();
        $data['inteviews'] = JobInterView::query()->where('user_id', auth()->id())->orderby('id', 'desc')->take(5)->get();
        $data['offer_count'] = Offer::query()->wherehas('project', function ($q) {
            $q->wherehas('company');
        })->where('user_id', auth()->id())->count();
        $data['job_count'] = ApplyJob::query()->where('user_id', auth()->id())->count();
        $data['inteview_count'] = JobInterView::query()->where('user_id', auth()->id())->count();
        $data['vistor_profile'] = auth()->user()->views;
        $data['constant_settings'] = Constant::query()->where('category', 'agreement')->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $hours_count = Attendance::query()
            ->where('user_id', auth()->id())
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('hours');


        $data['total_hours'] = $hours_count;







        return view('front.dashboard.index', $data);
    }

    public function updateBranch(Request $request)
    {


        $branch = Branch::query()->where('id', $request->branch_id)->first();


        $user_count = User::query()->where('branch_id', $request->branch_id)->count();
        //   dd($user_count);
        // if($branch && $branch->max <= $user_count){
        //     return response_web(false, 'الحاضنة غير متوفر الان بسبب اكتمال العدد', [], 500);
        // }

        // Assuming $request->settings is an array of setting_id => value


        JoinBranch::query()->updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'branch_id' => $request->branch_id
        ]);
        return response_web(true, 'نجاح العملية', [], 201);
    }

    public function survey(Request $request)
    {

        auth()->user()->surveys()->attach($request->survey);

        if($request->file('cv_file')){
        $file = $request->file('cv_file')->store('cvFile', 'public');
        auth()->user()->update([
            'cv_file' => $file,
        ]);

    }
        return response_web(true, 'نجاح العملية', [], 201);
    }
}
