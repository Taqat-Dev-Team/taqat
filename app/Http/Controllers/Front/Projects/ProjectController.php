<?php

namespace App\Http\Controllers\Front\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Projects\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {

        return view('front.projects.index');
    }

    public function getIndex(Request $request)
    {


        $serach=$request->search['value']??false;
        $data = Project::query()
        ->when($serach,function($q)use($serach){
            $q->where('title', 'like', '%'.$serach.'%');
        })
            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
        ->addColumn('title', function ($data) {


            return $data->title;


        })
        ->addColumn('photo', function ($data) {
            return '<img src="'.$data->getAttachment().'" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">';

        })
            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.projects.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->title . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action','photo'])
            ->make(true);
    }

    public function create()
    {
        $data['projectTypes']=ProjectType::query()->get();

        return view('front.projects.add',$data);
    }


    public function saveProjectImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = upload( $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function  store(ProjectRequest $request)
    {
        try {

            $title = ['ar' => $request->title, 'en' =>  $request->title];
            $description = ['ar' =>$request->description, 'en' => $request->description];


            $photo = "";
            if ($request->hasFile('photo')) {
                $photo = upload($request->photo); // Adjust storage path as needed
            }


            $project = Project::query()->create([
                'title' => $title,
                'user_id' => auth()->id(),
                'url' => $request->url,
                'description' => $description,
                'photo' => $photo,
                'vedio_url' => $request->vedio_url,
                'project_type' => $request->project_type_id
            ]);





            if ($request->document) {
                foreach ($request->document as $value) {

                    ProjectImage::query()->create([
                        'project_id' => $project->id,
                        'photo' => $value,
                    ]);
                }

            }
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {
        $data['projectTypes']=ProjectType::query()->get();

         $data['project'] = Project::query()->where('id',$id)->where('user_id',auth()->id())->first()??abort(404);
        return view('front.projects.edit', $data);
    }

    public function  update(ProjectRequest $request)
    {
        try {
            $project = Project::query()->findorfail($request->project_id);

            if($request->photo){
                $photo=Upload($request->photo);
                $project->update([

                    'photo'=>$photo
                ]
                );
            }


            if ($request->document) {
                foreach ($request->document as $value) {

                    ProjectImage::query()->create([
                        'project_id' => $project->id,
                        'photo' => $value,
                    ]);
                }

            }

            $title = ['ar' => $request->title, 'en' =>  $request->title];
            $description = ['ar' =>$request->description, 'en' => $request->description];

            $project->update([
                'title' => $title,
                'url' => $request->url,
                'description' => $description,
                'vedio_url'=>$request->vedio_url,
                'project_type'=>$request->project_type_id

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        Project::query()->where('id', $request->id)->delete();

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }

    public function deleteProjectImages(Request $request){
        $projectImage=ProjectImage::query()->where('id',$request->id)->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);

    }
}
