<?php

namespace App\Http\Controllers\Front\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //

    public  function  index()
    {
        return view('front.appointments.index');
    }

    public function getData(Request $request)
    {
        $appointments = Appointment::all();

            return response()->json($appointments->map(function($appointment) {
                return [
                    'title' => $appointment->title,
                    'name'  => $appointment->user->name ?? 'غير معروف', // مثال إذا كان مرتبط بمستخدم
                    'start' => $appointment->date . 'T' . $appointment->start_time,
                    'end'   => $appointment->date . 'T' . $appointment->end_time,
                ];
            }));
    }


    public function store(Request $request)
    {
        $event = new Appointment();
        $event->title = $request->title;
        $event->time = now();
        $event->date = today();
        $event->save();

        return response()->json(['status' => 'Event created']);
    }
}
