<?php

namespace App\Http\Controllers\Front\Constracts;

use App\Http\Controllers\Controller;
use App\Models\Contracts;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContstractController extends Controller
{

    public function index(){
        $contrancts=Contracts::query();

        $data['contrancts_count']=$contrancts->where('user_id',auth()->id())->count()??0;
        $data['contrancts_total_sallary']=$contrancts->where('user_id',auth()->id())->sum('sallary');
        $data['contrancts_min_salary']=$contrancts->where('user_id',auth()->id())->min('sallary');
        $data['contrancts_max_salary']=$contrancts->where('user_id',auth()->id())->max('sallary');

        return view('front.contrancts.index',$data);
    }

    public function getIndex(Request $request){
        $data = Contracts::query()
        ->where('user_id',auth()->id())
        ->orderBy('id', 'desc');


    return DataTables::of($data)
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
    ->addColumn('company_name', function ($data) {

        return $data->company?$data->company->name:'-';

    })

    ->addColumn('job_title', function ($data) {

        return $data->job?$data->job->title:'-';

    })

    ->addColumn('specializations', function ($data) {

        return $data->specializations?$data->specializations->title:'-';

    })->rawColumns(['attachment'])



    ->make(true);

}

}
