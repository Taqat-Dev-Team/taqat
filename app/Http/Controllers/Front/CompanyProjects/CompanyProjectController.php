<?php

namespace App\Http\Controllers\Front\CompanyProjects;

use App\Http\Controllers\Controller;
use App\Models\CompanyProject;
use App\Models\MyStone;
use App\Models\ProjectReview;
use App\Models\UserProjectRatting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyProjectController extends Controller
{
    public function index()
    {
        $data['projects'] = CompanyProject::query()->orderby('id', 'desc')->paginate(10);
        foreach ($data['projects'] as $item) {
            $item->short_description = getMaxWords($item->description, 40);
        }

        return view('front.companyProjects.index', $data);
    }

    public function view($slug)
    {

        // dd($slug);
        $project = CompanyProject::query()->where('slug','like','%'.$slug.'%')->first()??abort(404);
        $data['project'] = $project;
        $data['ratings']  = UserProjectRatting::where('project_id', $project->id)->first();
        $data['userRattings']  = ProjectReview::where('project_id', $project->id)->first();


        return view('front.companyProjects.view', $data);
    }

    public function addReviews(Request $request)
    {
        $projectReview = ProjectReview::query()->where('project_id', $request->project_id)->where('user_id', auth()->id())->first();



        ProjectReview::query()->updateOrCreate(
            [
                'project_id' => $request->project_id,
                'user_id' => auth()->id(),

            ],
            [
                'message' => $request->message,
                'rate' => $request->rating,
            ]
        );
        return response_web(true, 'تم الاضافة بنجاح', [], 201);
    }
    public function storeMyStone(Request $request)
    {
        $project = CompanyProject::query()->findOrFail($request->project_id);
        $mystone = MyStone::query()->create([
            'project_id' => $project->id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
        ]);

        $response['data'] = $mystone;
        return response_web(true, __('label.success_full_process'), $response, 201);
    }
}
