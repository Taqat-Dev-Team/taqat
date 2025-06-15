<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->where('company_id',auth('company')->id())->get();
        return view('companies.attendances.index', $data);
    }

    public function getIndex(Request $request)
    {

        $user_id = $request->user_id ?? false;
        $date =$request->date?Carbon::parse($request->date)->format('Y-m-d'):Carbon::now()->format('Y-m-d');

        $data = User::query()
        ->where('company_id',auth('company')->id())
            ->when($user_id, function ($query) use ($user_id) {
                $query->whereIn('id', (array) $user_id);
            })

            ->with(['attendances' => function ($query) use ($date) {
                if ($date) {
                    $query->where('date', Carbon::parse($date)->format('Y-m-d'));
                }
                $query->orderBy('date', 'desc');
            }])
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
                return '<a href="' . route('companies.users.views', $data->id) . '"><img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;height:50px;width:50px;border-radius: 50%;"></a>';
            })

            ->addColumn('login_time', function ($data) {
                $attendance = $data->attendances->first();
                return $attendance ? Carbon::parse($attendance->login_time)->format('H:i') : '-';
            })
            ->addColumn('logout_time', function ($data) {
                $attendance = $data->attendances->first();
                return $attendance && $attendance->logout_time ? Carbon::parse($attendance->logout_time)->format('H:i') : '-';
            })
            ->addColumn('date', function ($data) {
                $attendance = $data->attendances->first();
                return $attendance ? $attendance->date : '-';
            })
            ->addColumn('hours', function ($data) {
                $attendance = $data->attendances->first();
                if ($attendance && $attendance->logout_time) {
                    $start_time = Carbon::parse($attendance->login_time);
                    $end_time = Carbon::parse($attendance->logout_time);
                    return $start_time->diffInHours($end_time);
                }
                return '-';
            })
            ->rawColumns(['photo'])
            ->make(true);

    }



    public function getData(Request $request){

        $user_id = $request->input('user_id');
        $date = $request->input('date') ? Carbon::parse($request->input('date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');

        $data = User::query()
        ->where('company_id',auth('company')->id())

            ->when($user_id, function ($query) use ($user_id) {
                $query->whereIn('id', (array) $user_id);
            })
    
            ->with(['attendances' => function ($query) use ($date) {
                $query->where('date', $date)
                      ->orderBy('date', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->get();

        $user_count = $data->count();

        $absence_count = $data->filter(function ($user) use ($date) {
            return !$user->attendances->where('date', $date)->count();
        })->count();


      $presence_count = $data->filter(function ($user) use ($date) {
            return $user->attendances->where('date', $date)->count();
        })->count();
        $total_hours = $data->sum(function ($user) use ($date) {
            return $user->attendances->where('date', $date)->sum('hours');
        });


        $response['data'] = [
            'user_count' => $user_count,
            'absence_count' => $absence_count,
            'presence_count' => $presence_count,
            'hours_count'=>$total_hours
        ];

        return response()->json($response);

    }

}
