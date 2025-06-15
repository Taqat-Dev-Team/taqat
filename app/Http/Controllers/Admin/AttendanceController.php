<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->get();
        $data['branches']=Branch::get();
        $data['companies'] = Company::query()->get();
        return view('admin.attendances.index', $data);
    }

    public function getIndex(Request $request)
{
    $admin = auth('admin')->user();
    $user_id = $request->user_id ?? false;
    $company_id = $request->company_id ?? false;
    $date = $request->input('date') ? Carbon::parse($request->input('date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
    $branch_id = $request->branch_id ?? false;


    $order_column = $request->order[0]['column']; // Index of the column to order by
    $order_direction = $request->order[0]['dir'];  // Direction of the order (asc or desc)

    $columns = [
        '0' => 'photo',
        '1' => 'name',
        '2' => 'date', // Use the alias for the attendance date
        '3' => 'login_time',
        '4' => 'logout_time',
        '5' => 'hours',
        '6' => 'action',
    ];

    // $today = Carbon::today()->format('Y-m-d'); // Get the current date

    // Subquery to get the latest attendance record per user
    $latestAttendance = DB::table('attendances as a')
        ->select('a.user_id',
                 'a.date',
                 'a.login_time',
                 'a.logout_time')
        ->whereDate('a.date', $date)
        ->groupBy('a.user_id', 'a.date', 'a.login_time', 'a.logout_time')
        ->orderBy('a.date', 'desc');

    $query = User::query()
        ->leftJoinSub($latestAttendance, 'latest_attendance', function ($join) {
            $join->on('users.id', '=', 'latest_attendance.user_id');
        })
        ->when($branch_id, function($q) use($branch_id) {
            $q->whereHas('branch', function($q) use($branch_id) {
                $q->where('id', $branch_id);
            });
        })
        ->when($admin->branch_id, function($q) use($admin) {
            $q->whereHas('branch', function($q) use($admin) {
                $q->where('id', $admin->branch_id);
            });
        })
        ->where('status', '=', 1)
        ->when($user_id, function ($query) use ($user_id) {
            $query->whereIn('users.id', (array) $user_id);
        })
        ->when($company_id, function ($query) use ($company_id) {
            $query->whereIn('company_id', (array) $company_id);
        });

    // Apply dynamic sorting
    if (array_key_exists($order_column, $columns)) {
        $column_name = $columns[$order_column];
        if ($column_name === 'attendance_date') {
            $query->orderBy('latest_attendance.attendance_date', $order_direction);
        } elseif ($column_name === 'login_time') {
            $query->orderBy('latest_attendance.login_time', $order_direction);
        } elseif ($column_name === 'logout_time') {
            $query->orderBy('latest_attendance.logout_time', $order_direction);
        } elseif ($column_name === 'hours') {
            $query->orderBy('latest_attendance.hours', $order_direction);
        } elseif ($column_name === 'name') {
            $query->orderBy('users.name', $order_direction);
        } else {
            $query->orderBy($column_name, $order_direction);
        }
    } else {
        $query->orderBy('users.id', 'desc'); // Default order
    }

    return DataTables::of($query)
        ->addColumn('photo', function ($data) {
            return '<a href="' . route('admin.users.views', $data->id) . '"><img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
        })
        ->addColumn('login_time', function ($data) {
            return $data->login_time ? Carbon::parse($data->login_time)->format('H:i') : '-';
        })
        ->addColumn('logout_time', function ($data) {
            return $data->logout_time ? Carbon::parse($data->logout_time)->format('H:i') : '-';
        })
        ->addColumn('date', function ($data) {
            return $data->date ? Carbon::parse($data->date)->format('Y-m-d') : '-';
        })


        ->addColumn('hours', function ($data) {
            if ($data->login_time && $data->logout_time) {
                $start_time = Carbon::parse($data->login_time);
                $end_time = Carbon::parse($data->logout_time);
                return $start_time->diffInHours($end_time);
            }
            return '-';
        })
        ->addColumn('action', function ($data) {

            return view('admin.attendances.partials.actions', compact('data'));

        })
        ->rawColumns(['photo', 'action'])
        ->make(true);
}



    public function getData(Request $request)
    {
        $admin = auth('admin')->user();

        $user_id = $request->input('user_id');
        $company_id = $request->input('company_id');
        $date = $request->input('date') ? Carbon::parse($request->input('date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $branch_id = $request->input('branch_id')??false;


        $data = User::query()
        ->when($admin->branch_id, function ($q) use ($admin) {
            $q->whereHas('branch', function ($q) use ($admin) {
                $q->where('id', $admin->branch_id);
            });
        })
            ->when($branch_id, function ($q) use ($branch_id) {
                $q->whereHas('branch', function ($q) use ($branch_id) {
                    $q->where('id', $branch_id);
                });
            })
            ->where('status', '=', 1)
            ->when($user_id, function ($query) use ($user_id) {
                $query->whereIn('id', (array) $user_id);
            })
            ->when($company_id, function ($query) use ($company_id) {
                $query->whereIn('company_id', (array) $company_id);
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
        $total_hours=0;
        foreach ($data as $user) {
            // Loop through each user's attendances and filter by the specific date
            foreach ($user->attendances->where('date', $date) as $attendance) {
                $total_hours += $attendance->hours; // Sum the 'hours' for the filtered attendances
            }
        }




        $response['data'] = [
            'user_count' => $user_count,
            'absence_count' => $absence_count,
            'presence_count' => $presence_count,
            'hours_count' => $total_hours
        ];

        return response()->json($response);
    }
    public function attendances(Request $request)
    {


        $time = Carbon::parse($request->time)->format('H:i');
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $dateTime = Carbon::createFromFormat('Y-m-d H:i', "$date $time");



        $attendances =  Attendance::query()->whereNull('logout_time')->where('date', Carbon::parse($request->date)->format('Y-m-d'))->get();

        foreach ($attendances as $attendance) {
            $attendance->update([
                'logout_time' => $dateTime,

            ]);

            $start_time = Carbon::parse($attendance->login_time);
            $end_time = Carbon::parse($dateTime);

            $hours = $start_time->diffInHours($end_time);

            $attendance->update([
                'hours' => $hours,
                'logout_time' => $dateTime,

            ]);
        }


        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }

    public function update(Request $request)
    {


        $dateLogoutTime = null;
        $login_time = null;
        $hours = null;
        $dateLoginInTime = null;
        $logout_time = $request->logout_time ? Carbon::parse($request->logout_time)->format('H:i') : null;
        $login_time = $request->login_time ? Carbon::parse($request->login_time)->format('H:i') : null;


        $date = Carbon::parse($request->date)->format('Y-m-d');


        if ($login_time) {
            $dateLoginInTime = Carbon::createFromFormat('Y-m-d H:i', "$date $login_time");
        }

        if ($logout_time) {
            $dateLogoutTime = Carbon::createFromFormat('Y-m-d H:i', "$date $logout_time");
        }

        if ($dateLogoutTime && $login_time) {
            $hours = $dateLogoutTime->diffInHours($dateLoginInTime);
        }


        Attendance::query()->updateOrCreate([
            'user_id' => $request->user_id,
            'date' => $date,
        ], [
            'logout_time' => $dateLogoutTime,
            'login_time' => $dateLoginInTime,
            'hours' => $hours,

        ]);
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
