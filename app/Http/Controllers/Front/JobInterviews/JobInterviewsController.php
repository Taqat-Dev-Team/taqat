<?php

namespace App\Http\Controllers\Front\JobInterviews;

use App\Http\Controllers\Controller;
use App\Models\JobInterView;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobInterviewsController extends Controller
{
    public function index(){
        // return 'asas';
        return view('front.interview.index');
    }

    public function getIndex(Request $request){
        $data = JobInterView::query()
        ->where('user_id',auth()->id())
        ->orderBy('id', 'desc');


    return DataTables::of($data)
    ->addColumn('company_name', function ($data) {

        return $data->company?$data->company->name:'-';

    })
    ->addColumn('jobs', function ($data) {

        return $data->jobs?$data->jobs->title:'-';

    })

    ->addColumn('zoom_url', function ($data) {

        return '<a href="'.$data->zoom_url.'" class="btn btn-success" target="_blank">رابط الاجتماع</a>';

    })




    ->addColumn('action', function ($data) {
        $button = '';
        $button .= '<a><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';



        return $button;
    })->rawColumns(['action','zoom_url'])
    ->make(true);


}

}
