<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{

    public function index(){
        $data['presence_count']=Attendance::query()->where('user_id',auth()->id())->count();
        $data['hours_count']=Attendance::query()->where('user_id',auth()->id())->sum('hours');
        $data['hours_current_month_count']=Attendance::query()->where('user_id',auth()->id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('hours');


        return view('front.attendances.index',$data);
    }
    public function getIndex(Request $request)
    {

        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
        $data = Attendance::query()

            ->when($start_date&&$end_date,function ($q)use ($start_date,$end_date){
                $q->whereBetween('created_at',[$start_date,$end_date]);
            })
        ->where('user_id',$request->user_id)
            ->orderBy('id', 'desc');

        return DataTables::of($data)
        ->addColumn('login_time',function($data){
            return  $data->login_time?Carbon::parse($data->login_time)->format('H:i'):'-';
        })
        ->addColumn('logout_time',function($data){
            return  $data->logout_time?Carbon::parse($data->logout_time)->format('H:i'):'-';
        })
            ->make(true);
    }


    public  function  getData(Request $request){

        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;

        $attendance=Attendance::query()->where('user_id',auth()->id())->when($start_date&&$end_date,function ($q)use ($start_date,$end_date){
            $q->whereBetween('created_at',[$start_date,$end_date]);
        });
        $data['presence_count']=$attendance->where('user_id',auth()->id())->count();
        $data['hours_count']=$attendance->where('user_id',auth()->id())->sum('hours');

        $response['data']=$data;
        return response()->json($response);

    }


}
