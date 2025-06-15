<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Get user ID and parse dates
        $user_id = $request->user_id;
        $branch_id = $request->branch_id;


        $start_date = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))->format('Y-m-d')
            : Carbon::now()->subDays(30)->format('Y-m-d');

        $end_date = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');

        // Initialize data array
        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        // Fetch attendance records within the date range
        $attendances = Attendance::query()
            ->whereHas('user', function ($q) use ($user_id) {
                $admin = auth('admin')->user();

                $q->where('status', 1)
                    ->when($admin->branch_id, function ($q) use ($admin) {
                        $q->whereHas('branch', function ($q) use ($admin) {
                            $q->where('id', $admin->branch_id);
                        });
                    });
                if ($user_id) {
                    $q->where('id', $user_id);
                }
            })
            ->when($branch_id, function ($q) use ($branch_id) {
                $q->whereHas('user', function ($q) use ($branch_id) {
                    $q->where('branch_id', $branch_id);
                });
            })
            ->whereBetween('date', [$start_date, $end_date])
            // ->whereNull('logout_time') // Filter out records where logout_time is null
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by date and calculate counts and total hours
        $grouped = $attendances->groupBy('date')->map(function ($group) {
            // dd($group);
            $first_login_time = $group->min('login_time');
            $last_logout_time = $group->max('logout_time');
            return [
                'count_present' => $group->count(),
                'total_hours' => $group->sum('hours'),
                'start_time' => $first_login_time,
                'end_time' => $last_logout_time,
            ];
        });

        $admin = auth('admin')->user();

        // Fetch all active users
        $allUsers = User::query()
            ->where('status', 1)
            ->when($user_id, function ($q) use ($user_id) {
                $q->where('id', $user_id);
            })
            ->when($branch_id, function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->whereHas('branch', function ($q) use ($admin) {
                    $q->where('id', $admin->branch_id);
                });
            })
            ->whereHas('attendances', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('date', [$start_date, $end_date]);
            })
            ->get();

        // Process attendance data
        $data['attendances'] = $grouped->map(function ($data, $date) use ($allUsers) {
            $presentCount = $data['count_present'];
            $totalHours = $data['total_hours'];
            $totalUsers = $allUsers->count();
            $absentCount = $totalUsers - $presentCount;
            $start_time = $data['start_time'];
            $end_time = $data['end_time'];

            return [
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'total_hours' => $totalHours,
                'count_present' => $presentCount,
                'absent_count' => $absentCount,
            ];
        });

        // Fetch users with attendance data
        $users = User::query()
            ->when($admin->branch_id_supper, function ($q) use ($admin) {
                $q->whereHas('branch', function ($q) use ($admin) {
                    $q->where('id', $admin->branch_id);
                });
            })
            ->where('status', 1)
            ->when($user_id, function ($q) use ($user_id) {
                $q->where('id', $user_id);
            })

            ->when($branch_id, function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            })
            ->with(['attendances' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('date', [$start_date, $end_date])
                    ->orderBy('date', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->get();

        // Calculate overall total hours and attendance counts
        $overallTotalHours = $attendances->sum('hours');
        $total_hours = $users->sum(function ($user) use ($start_date, $end_date) {
            return $user->attendances->whereBetween('date', [$start_date, $end_date])->sum('hours');
        });
        $user_count = $users->count();
        $absence_count = $users->filter(function ($user) use ($start_date, $end_date) {
            return !$user->attendances->whereBetween('date', [$start_date, $end_date])->count();
        })->count();
        $presence_count = $users->filter(function ($user) use ($start_date, $end_date) {
            return $user->attendances->whereBetween('date', [$start_date, $end_date])->count();
        })->count();

        $branches = Branch::query()->get();
        // Prepare final data array
        $data = array_merge($data, [
            'users' => $allUsers,
            'user_id' => $user_id,
            'branches' => $branches,
            'branch_id' => $branch_id,
            'overallTotalHours' => $overallTotalHours,
            'total_hours' => $total_hours,
            'presence_count' => $presence_count,
            'absence_count' => $absence_count,
            'user_count' => $user_count,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        ]);

        // Return the view with data
        return view('admin.reports.index', $data);
    }

    public function searchReports(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : Carbon::now()->subDay(30)->format('Y-m-d');
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $admin = auth('admin')->user();

        $data = User::query()
            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->wherehas('branch', function ($q) use ($admin) {
                    $q->where('id', $admin->branch_id);
                });
            })
            ->where('status', '=', 1)
            ->with(['attendances' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('date', [$start_date, $end_date])
                    ->orderBy('date', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->get();

        $user_count = $data->count();

        $absence_count = $data->filter(function ($user) use ($start_date, $end_date) {
            return !$user->attendances->whereBetween('date', [$start_date, $end_date])->count();
        })->count();


        $presence_count = $data->filter(function ($user) use ($start_date, $end_date) {
            return $user->attendances->whereBetween('date', [$start_date, $end_date])->count();
        })->count();
        $total_hours = $data->sum(function ($user) use ($start_date, $end_date) {
            return $user->attendances->whereBetween('date', [$start_date, $end_date])->sum('hours');
        });



        $response['data'] = [
            'hours_count' => $total_hours
        ];
        return response_web(true, 'تم تنفيد العملية بنجاح', $response, 201);
    }

    public function getAattendances(Request $request)
    {
        $admin = auth('admin')->user();

        $user_id = $request->user_id;
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : Carbon::now()->subDay(30)->format('Y-m-d');
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $data['attendances'] = Attendance::query()
            ->whereHas('user', function ($q) use ($user_id) {
                $admin = auth('admin')->user();

                $q
                    ->when($admin->branch_id, function ($q) use ($admin) {
                        $q->wherehas('branch', function ($q) use ($admin) {
                            $q->where('id', $admin->branch_id);
                        });
                    })->where('status', 1);
                if ($user_id) {
                    $q->where('id', $user_id);
                }
            })
            ->whereBetween('date', [$start_date, $end_date])
            ->whereNotNull('logout_time') // Assuming you want to filter out records where logout_time is null
            ->orderBy('created_at', 'desc')
            ->get();
        $data['user_id'] = $request->user_id;
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');

        $data['users'] = User::query()
            ->when(!$admin->is_supper, function ($q) use ($admin) {
                $q->wherehas('branch', function ($q) use ($admin) {
                    $q->where('id', $admin->branch_id);
                });
            })
            ->where('status', 1)->get();
        $data['overallTotalHours'] = Attendance::query()
            ->whereHas('user', function ($q) use ($user_id) {
                $q->where('status', 1);
                if ($user_id) {
                    $q->where('id', $user_id);
                }
            })
            ->whereBetween('date', [$start_date, $end_date])
            ->whereNotNull('logout_time')
            ->sum('hours');
        return view('admin.reports.user_report', $data);
    }
}
