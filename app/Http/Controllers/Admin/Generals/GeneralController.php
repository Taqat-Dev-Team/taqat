<?php

namespace App\Http\Controllers\Admin\Generals;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ScientificCertificate;
use App\Models\TrainingCourse;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GeneralController extends Controller
{
    public function getProjects(Request $request)
    {
        $data = Project::query()
        ->where('user_id',$request->user_id)
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
        ->addColumn('photo', function ($data) {
            return '<img src="'.$data->getPhoto().'" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">';

        })

           ->rawColumns(['action','photo'])
            ->make(true);
    }

    public function getScientificCertificates(Request $request){
        $data = ScientificCertificate::query()
        ->where('user_id',$request->user_id)
        ->orderby('created_at', 'desc');

        return DataTables::of($data)
        ->addColumn('action', function ($data) {


            $button='';
                $button .= '<a  href="' . route('front.scientificCerificates.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->title . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

            return $button;
        })->rawColumns(['action'])
        ->make(true);



    }

    public function getTrainingCourses(Request $request){
        $data = TrainingCourse::query()
        ->where('user_id',$request->user_id)
        ->orderby('created_at', 'desc');

        return DataTables::of($data)
        ->addColumn('action', function ($data) {


            $button='';
                $button .= '<a  href="' . route('front.trainingCourses.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->title . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

            return $button;
        })->rawColumns(['action', 'image', 'status'])
        ->make(true);



    }

    public function getWorkExperiences(Request $request){
        $data = WorkExperience::query()->orderby('created_at', 'desc')
        ->where('user_id',$request->user_id);

        return DataTables::of($data)
        ->addColumn('action', function ($data) {


            $button='';
                $button .= '<a  href="' . route('front.workExperiences.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->company_name . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

            return $button;
        })->rawColumns(['action', 'image', 'status'])
        ->make(true);



    }
}
