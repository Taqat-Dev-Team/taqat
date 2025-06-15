<?php

namespace App\Http\Controllers\Admin\JobInterviews;

use App\Http\Controllers\Controller;
use App\Models\JobInterView;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobInterviewsController extends Controller
{
    public function index(){
        return view('admin.interview.index');
    }

    public function getIndex(Request $request){
        $data = JobInterView::query()
        ->orderBy('id', 'desc');


    return DataTables::of($data)
    ->addColumn('user_name', function ($data) {

        return $data->users?'<a href='.route('admin.users.views',$data->users->id).'>'.$data->users->name.'</a>':'-';

    })
    ->addColumn('company_name', function ($data) {

        return $data->company?$data->company->name:'-';

    })
    ->addColumn('jobs', function ($data) {

        return $data->jobs?$data->jobs->title:'-';

    })
    ->addColumn('name', function ($data) {


    $button = '<a href="https://team.taqat-gaza.com/admin/users/view/' . $data->user_id . '" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $data->name . '</a>';
    $button .= '<div><a class="text-muted font-weight-bold text-hover-primary" href="#">' . $data->company->name . '</a></div>';
    return $button;
    })

    ->addColumn('zoom_url', function ($data) {

        return '<a href="'.$data->zoom_url.'" class="btn btn-success" target="_blank">'.__('label.url_meet').'</a>';

    })





    ->addColumn('action', function ($data) {
        $button = '';
        $button .= '<a><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';



        return $button;
    })->rawColumns(['action','name','user_name','zoom_url'])
    ->make(true);


}

}
