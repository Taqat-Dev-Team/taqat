<?php

namespace App\Http\Controllers\Companies\JobInterviews;

use App\Http\Controllers\Controller;
use App\Models\JobInterView;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobInterviewsController extends Controller
{

    public function index(){
        return view('companies.interview.index');
    }

    public function getIndex(Request $request){
        $data = JobInterView::query()
        ->where('company_id',auth('company')->id())
        ->orderBy('id', 'desc');


    return DataTables::of($data)
    ->addColumn('user_name', function ($data) {

        return $data->users?$data->users->name:'-';

    })
    ->addColumn('jobs', function ($data) {


        if($data->jobs){
        return $data->jobs->title;

        }

        if($data->projects){
            return $data->projects->title;

            }

    })


    ->addColumn('zoom_url', function ($data) {

        return '<a href="'.$data->zoom_url.'" class="btn btn-success" target="_blank">'.__('label.url_meet').'</a>';

    })


    ->addColumn('action', function ($data) {
        $button = '';
        $button .= '<a><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';



        return $button;
    })->rawColumns(['action','zoom_url'])
    ->make(true);


}
}
