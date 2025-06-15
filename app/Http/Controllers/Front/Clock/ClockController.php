<?php

namespace App\Http\Controllers\Front\Clock;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClockController extends Controller
{
    //

    public function in(){
        $attendance = Attendance::query()
        ->whereDate('date', now()->toDateString())
        ->where('user_id', auth()->id())
        ->first();

        auth()->user()->update([
            'last_attendance_date'=>Carbon::today(),
        ]);
        Attendance::query()->updateOrCreate([
            'date' => Carbon::today(),
            'user_id' => auth()->id(),

        ],[
            'login_time' => Carbon::now(),
            'date' => Carbon::today(),
            'logout_time'=>null

        ]);


       
       $response['data']=null;
       return response_web(true,__('تم تنفيد العملية بنجاح'),$response,201);

    }



    public function out(){

        $attendance = Attendance::where('user_id', auth()->id())
        ->latest()
        ->first();

        auth()->user()->update([
            'last_attendance_date'=>null,
        ]);
    if ($attendance) {
        $attendance->update(['logout_time' => Carbon::now()]);

        $attendance = Attendance::where('user_id', auth()->id())
            ->latest()
            ->first();


        $start_time = Carbon::parse($attendance->login_time);
        $end_time = Carbon::parse($attendance->logout_time);

        $hours = $start_time->diffInHours($end_time);

        $attendance->update([
            'hours' => $hours,
        ]);
    }
       $response['data']=null;
       return response_web(true,__('تم تنفيد العملية بنجاح'),$response,201);

    }



}
