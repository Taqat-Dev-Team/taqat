<?php

namespace App\Http\Controllers\Companies\Contracts;

use App\Http\Controllers\Controller;
use App\Models\Contracts;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContranctsController extends Controller
{

    public function index(){
        $contrancts=Contracts::query();
        $data['contrancts_count']=$contrancts->where('company_id',auth('company')->id())->count()??0;
        $data['contrancts_total_sallary']=$contrancts->where('company_id',auth('company')->id())->sum('sallary');
        $data['contrancts_min_salary']=$contrancts->where('company_id',auth('company')->id())->min('sallary');
        $data['contrancts_max_salary']=$contrancts->where('company_id',auth('company')->id())->max('sallary');
        return view('companies.contrancts.index',$data);
    }

    public function getIndex(Request $request){
        $data = Contracts::query()
        ->where('company_id',auth('company')->id())
        ->orderBy('id', 'desc');


    return DataTables::of($data)
    ->addColumn('user_name', function ($data) {

        return $data->users?$data->users->name:'-';

    })
    ->addColumn('attachment', function ($data) {

        $attachments = $data->getAttachment();
        $extension = pathinfo($attachments, PATHINFO_EXTENSION);

        // dd($extension);
        $attachment = '';
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $attachment .= '<a href="' . $attachments . '" target="_blank"><img src="' . $attachments . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt=""></a>';
        } else if (in_array($extension, ['pdf'])) {
            $attachment .= '<a href="' . $attachments . '" target="_blank">
        <i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius: 50%;font-size: 70px; color: red;"></i>
    </a>';
        } else {

            $attachment .= '<img src="' . asset('assets/default.png') . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">';
        }
        return $attachment;
    })

    ->addColumn('job_title', function ($data) {

        return $data->job?$data->job->title:'-';

    })

    ->addColumn('specializations', function ($data) {

        return $data->specializations?$data->specializations->title:'-';

    })



    ->addColumn('action', function ($data) {
        $button = '';

        $button .= '<a><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';



        return $button;
    })->rawColumns(['attachment', 'action'])
    ->make(true);
}


}
