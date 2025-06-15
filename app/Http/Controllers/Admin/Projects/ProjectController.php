<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Models\CompanyProject;
use App\Models\MyStone;
use App\Models\Offer;
use App\Models\Project;
use App\Models\UserProjectRatting;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index($slug=null)
    {


        $company_projects = CompanyProject::query()



            ->when($slug == 'pennding', function ($q) use ($slug) {

                $q->where('status', 1);
            })

            ->when($slug == 'processing', function ($q) use ($slug) {
                $q->where('status', 2);
            })


            ->when($slug == 'completed', function ($q) use ($slug) {
                $q->where('status', 3);
            })


            ->when($slug == 'reject', function ($q) use ($slug) {
                $q->where('status', 4);
            })


            ->when($slug == 'ratting', function ($q) use ($slug) {
                $q->where('status', 3)->wherehas('compnayRatting');
            })


            ->when($slug == 'not-ratting', function ($q) use ($slug) {
                $q->where('status', 3)->doesntHave('compnayRatting');
            });
$data['project_count']=$company_projects->count();
        $data['projects'] =$company_projects
            ->orderby('created_at', 'desc')
            ->paginate(10);

        foreach ($data['projects'] as $item) {
            $item->short_description = getMaxWords($item->description, 40);
        }

        return view('admin.projects.index', $data);
    }

    public function show($id)
    {
        $data['project'] = CompanyProject::query()->findOrFail($id);
        $data['project_count']=CompanyProject::count();
        $data['ratings']  = UserProjectRatting::where('project_id', $id)->first();

        return view('admin.projects.view', $data);
    }


    public  function  delete(Request $request){

      $project= CompanyProject::query()->findOrFail($request->id);
      Offer::query()->where('project_id',$project->id)->delete();

      MyStone::query()->where('project_id',$project->id)->delete();
        $project->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);

    }
}
