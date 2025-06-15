<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exports\CompletionReportExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Contracts;
use App\Models\IncomeMovement;
use App\Models\jobContract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class CompletionReportController extends Controller
{


    public function index(Request $request)
    {

        $admin=auth('admin')->user();
        $data['start_date']  = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))->format('Y-m-d')
            : null;

        $data['end_date'] = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->format('Y-m-d')
            :              null;

        $data['users']=User::query()
        ->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
        ->where('status',1)->get();
        $data['branches']=Branch::query()->get();
        $data['user_id']=$request->user_id;

        return view('admin.reports.completion_report', $data);
    }

//    public function getIndex(Request $request)
//    {
//        $admin = auth('admin')->user();
//        // Extract other filters...
//        $admin = auth('admin')->user();
//        $user_id = $request->user_id ?? false;
//        $company_id = $request->company_id ?? false;
//        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
//        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
//        $branch_id = $request->branch_id ?? false;
//
//        // Main query for users, including total attendance time via a left join
//        $attendanceSummary = DB::table('attendances as a')
//            ->select(
//                'a.user_id',
//                DB::raw('SUM(a.hours) as total_minutes') // Sum total minutes worked per user
//            )
//            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
//                $q->whereBetween('a.date', [$start_date, $end_date]);
//            })
//            ->groupBy('a.user_id');
//
//        $query = User::query()
////            ->withSum('attendances as hours', 'hours') // Calculate total salary from job contracts
//            ->withSum('attendances as hours', 'hours') // Calculate total salary from job contracts
//
//            ->withSum('jobContracts as total_contracts', 'sallary') // Calculate total salary from job contracts
//            ->withSum('incomeMovements as total_amount', 'amount') // Calculate total salary from job contracts
//            ->withCount('incomeMovements as movements_count') // Calculate total salary from job contracts
//
//
//            ->leftJoinSub($attendanceSummary, 'attendance_summary', function ($join) {
//                $join->on('users.id', '=', 'attendance_summary.user_id');
//            })
//            ->where('status', '=', 1); // Only active users
//
//        // Sorting functionality
//        if ($request->has('order')) {
//            $orderColumnIndex = $request->input('order.0.column'); // Get the column index to sort
//            $orderDirection = $request->input('order.0.dir'); // Get the sorting direction (asc or desc)
//
//            // Map DataTable column index to your query fields
//            $columns = [
//                'photo',             // Index 0
//                'name',              // Index 1
//                //'total_hours',     // Index 2 (renamed to total_hours for DataTable)
//                'total_contracts',   // Index 3
//                'total_movements',   // Index 4
//                'movements_count',   // Index 5
//            ];
//
//            if (isset($columns[$orderColumnIndex])) {
////                if ($columns[$orderColumnIndex] === 'total_hours') {
////
////                    // Ordering by the total_minutes from the attendance_summary
////                    $query->orderBy('hours', $orderDirection);
////                }
//                if ($columns[$orderColumnIndex] === 'total_contracts') {
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query->orderBy('total_contracts', $orderDirection); // Use the alias created with withSum
//                }
//
//                if ($columns[$orderColumnIndex] === 'total_movements') {
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query->orderBy('total_amount', $orderDirection); // Use the alias created with withSum
//                }
//                if ($columns[$orderColumnIndex] === 'movements_count') {
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query->orderBy('movements_count', $orderDirection); // Use the alias created with withSum
//                }
//
//
//
//
//
//            }
//        }
//
//        // DataTables Response
//        return DataTables::of($query)
//            ->addColumn('photo', function ($data) {
//                return '<a href="' . route('admin.users.views', $data->id) . '"><img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
//            })
//            ->addColumn('name', function ($data) {
//                return '<a href="' . route('admin.users.views', $data->id) . '">' . $data->name . '</a>';
//            })
//            ->addColumn('total_hours', function ($data) {
//                if ($data->total_minutes !== null) {
//                  return  $data->total_minutes;
////                    $hours = floor($data->total_minutes / 60);
////                    $minutes = $data->total_minutes % 60;
////                    return sprintf('%02d:%02d', $hours, $minutes);
//                }
//                return '-';            })
//            ->addColumn('total_contracts', fn($data) => $data->totalContracts())
//            ->addColumn('total_movements', fn($data) => $data->totalIncome())
//            ->addColumn('movements_count', fn($data) => $data->IncomeCount())
//            ->rawColumns(['photo', 'name'])
//            ->make(true);
//    }


    public function getIndex(Request $request)
    {
        $admin = auth('admin')->user();
        $user_id = $request->user_id ?? false;
        $company_id = $request->company_id ?? false;
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
        $branch_id = $request->branch_id ?? false;

        $query = User::query()
            ->whereHas('attendances', function ($q) use ($start_date, $end_date) {
                $q->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('date', [$start_date, $end_date]);
                });
            })
            ->when($user_id, fn($q) => $q->where('id', $user_id))
            ->when($branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $branch_id)))
            ->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
            ->where('status', '=', 1) // Only active users
            ->withSum(['attendances as total_hours' => function ($q) use ($start_date, $end_date) {
                $q->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('date', [$start_date, $end_date]);
                });
            }], 'hours')
//            ->withSum('jobContracts as total_contracts', 'sallary') // Calculate total salary from job contracts
//            ->withSum('incomeMovements as total_amount', 'amount') // Calculate total amount from income movements


//            ->withCount('incomeMovements as movements_count'); // Count income movements


            ->withSum(['jobContracts as total_contracts' => function ($q) use ($start_date, $end_date) {
                $q->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]); // Adjust 'start_date' if needed
                });
            }], 'sallary') // Calculate total salary from job contracts
            ->withSum(['incomeMovements as total_amount' => function ($q) use ($start_date, $end_date) {
                $q->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });
            }], 'amount') // Calculate total amount from income movements
            ->withCount(['incomeMovements as movements_count' => function ($q) use ($start_date, $end_date) {
                $q->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });
            }]);
        // Apply ordering if requested
        if ($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column'); // Get the column index to sort
            $orderDirection = $request->input('order.0.dir'); // Get the sorting direction (asc or desc)

            $columns = [
                'photo',             // Index 0
                'name',              // Index 1
                'total_hours',       // Index 2 (renamed to total_hours for DataTable)
                'total_contracts',   // Index 3
                'total_movements',   // Index 4
                'movements_count',   // Index 5
            ];

            if (isset($columns[$orderColumnIndex])) {
                $column = $columns[$orderColumnIndex];
                switch ($column) {
                    case 'total_hours':
                        $query->orderBy('total_hours', $orderDirection);
                        break;
                    case 'total_contracts':
                        $query->orderBy('total_contracts', $orderDirection);
                        break;
                    case 'total_movements':
                        $query->orderBy('total_amount', $orderDirection);
                        break;
                    case 'movements_count':
                        $query->orderBy('movements_count', $orderDirection);
                        break;
                }
            }
        }

        // Check if export to Excel is requested
        if ($request->has('export') && $request->export == 'excel') {
            return Excel::download(new CompletionReportExport($query), 'users.xlsx');
        }

        // DataTables Response
        return DataTables::of($query)
            ->addColumn('photo', function ($data) {
                return '<a href="' . route('admin.users.views', $data->id) . '"><img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
            })
            ->addColumn('name', function ($data) {
                return '<a href="' . route('admin.users.views', $data->id) . '">' . $data->name . '</a>';
            })
            ->addColumn('total_hours', fn($data) => $data->total_hours ?? '-')
            ->addColumn('total_contracts', fn($data) => $data->total_contracts ?? '-')
            ->addColumn('total_movements', fn($data) => $data->total_amount ?? '-')
            ->addColumn('movements_count', fn($data) => $data->movements_count ?? '-')
            ->rawColumns(['photo', 'name'])
            ->make(true);
    }

//    public function getIndex(Request $request)
//    {
//        $admin = auth('admin')->user();
//        $user_id = $request->user_id ?? false;
//        $company_id = $request->company_id ?? false;
//        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
//        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
//        $branch_id = $request->branch_id ?? false;
//        $query = User::query()
//
//            ->whereHas('attendances',function ($q)use($start_date,$end_date){
//                $q->when($start_date&&$end_date,function ($q)use($start_date,$end_date){
//                    $q->whereBetween('date', [$start_date, $end_date]);
//                });
//            })
//
////            ->leftJoinSub($attendanceSummary, 'attendance_summary', function ($join) {
////                $join->on('users.id', '=', 'attendance_summary.user_id');
////            })
//            ->when($user_id, function ($q) use ($user_id) {
//                    $q->where('id', $user_id);
//            })
//            ->when($branch_id, function ($q) use ($branch_id) {
//                $q->whereHas('branch', function ($q) use ($branch_id) {
//                    $q->where('id', $branch_id);
//                });
//            })
//            ->when(!$admin->is_supper, function ($q) use ($admin) {
//                $q->whereHas('branch', function ($q) use ($admin) {
//                    $q->where('id', $admin->branch_id);
//                });
//            })
//            ->where('status', '=', 1) // Only active users
//            ->when($user_id, function ($query) use ($user_id) {
//                $query->whereIn('users.id', (array) $user_id);
//            });
//
//        $query->withSum(['attendancesWithinDateRange' => function ($q) use ($start_date, $end_date) {
//            $q->whereBetween('date', [$start_date, $end_date]);
//        }], 'hours as total_hours')
//
////        withSum('attendances as hours', 'hours') // Calculate total salary from job contracts
//
//            ->withSum('jobContracts as total_contracts', 'sallary') // Calculate total salary from job contracts
//            ->withSum('incomeMovements as total_amount', 'amount') // Calculate total salary from job contracts
//            ->withCount('incomeMovements as movements_count'); // Calculate total salary from job contracts
//
//
//        if ($request->has('order')) {
//            $orderColumnIndex = $request->input('order.0.column'); // Get the column index to sort
//            $orderDirection = $request->input('order.0.dir'); // Get the sorting direction (asc or desc)
//
//
//            $columns = [
//                'photo',             // Index 0
//                'name',              // Index 1
//                'total_hours',     // Index 2 (renamed to total_hours for DataTable)
//                'total_contracts',   // Index 3
//                'total_movements',   // Index 4
//                'movements_count',   // Index 5
//            ];
////
//            if (isset($columns[$orderColumnIndex])) {
//                if ($columns[$orderColumnIndex] === 'total_hours') {
//
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query=    $query->orderBy('hours', $orderDirection);
//                }
//                if ($columns[$orderColumnIndex] === 'total_contracts') {
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query=   $query->orderBy('total_contracts', $orderDirection); // Use the alias created with withSum
//                }
//
//                if ($columns[$orderColumnIndex] === 'total_movements') {
//                    // Ordering by the total_minutes from the attendance_summary
//                    $query=   $query->orderBy('total_amount', $orderDirection); // Use the alias created with withSum
//                }
//                if ($columns[$orderColumnIndex] === 'movements_count') {
//                    // Ordering by the total_minutes from the attendance_summary
//                   $query= $query->orderBy('movements_count', $orderDirection); // Use the alias created with withSum
//                }
//
//
//            }
//
//        }
//
//        if ($request->has('export') && $request->export == 'excel') {
//
//
//            return Excel::download(new CompletionReportExport($query), 'users.xlsx');
//        }
//        // DataTables Response
//        return DataTables::of($query)
//            ->addColumn('photo', function ($data) {
//                return '<a href="' . route('admin.users.views', $data->id) . '"><img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
//            })
//            ->addColumn('name', function ($data) {
//                return '<a href="' . route('admin.users.views', $data->id) . '">'.$data->name.'</a>';
//            })
//
//            ->addColumn('name', function ($data) {
//                return '<a href="' . route('admin.users.views', $data->id) . '">'.$data->name.'</a>';
//            })
//            ->addColumn('total_hours', function ($data) {
//
//                return  $data->total_hours??'-';
////                if ($data->total_minutes !== null) {
////                  return  $data->total_minutes;
//////                    $hours = floor($data->total_minutes / 60);
//////                    $minutes = $data->total_minutes % 60;
//////                    return sprintf('%02d:%02d', $hours, $minutes);
////                }
////                return '-';
//            })
//            ->addColumn('total_contracts', fn($data) => $data->totalContracts())
//            ->addColumn('total_movements', fn($data) => $data->totalIncome())
//            ->addColumn('movements_count', fn($data) => $data->IncomeCount())
//
//
//
//            ->rawColumns(['photo','name'])
//            ->make(true);
//    }

    public function getData(Request $request)
    {
        $admin = auth('admin')->user();
        $user_id = $request->user_id ?? null;
        $branch_id = $request->branch_id ?? null;
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;

        // Calculate attendance summary for each user
        $attendanceSummary = DB::table('attendances as a')
            ->select('a.user_id', DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.login_time, a.logout_time)) as total_minutes'))
            ->when($start_date && $end_date, fn($q) => $q->whereBetween('a.date', [$start_date, $end_date]))
            ->groupBy('a.user_id');

        // User query with attendance summary, filtering by branch and user status
        $query = User::query()
            ->leftJoinSub($attendanceSummary, 'attendance_summary', fn($join) => $join->on('users.id', '=', 'attendance_summary.user_id'))
            ->when($branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $branch_id)))
            ->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
            ->where('status', 1)  // Only active users
            ->when($user_id, fn($query) => $query->whereIn('users.id', (array) $user_id));

        // Calculate total salary from employment contracts
        $total_employment_contracts = number_format(
            JobContract::query()->whereHas('user', function ($q) use ($branch_id, $user_id, $start_date, $end_date) {
                $q->when(!auth('admin')->user()->is_supper, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', auth('admin')->user()->branch_id)))
                    ->when($branch_id, fn($q) => $q->where('branch_id', $branch_id))
                    ->when($user_id, fn($q) => $q->where('user_id', $user_id))
                    ->when($start_date && $end_date, fn($q) => $q->whereBetween('created_at', [$start_date, $end_date]));
            })->sum('sallary'), 2
        );

        // Calculate total amount from financial transactions
        $total_financial_transactions = number_format(
            IncomeMovement::query()->whereHas('user', function ($q) use ($branch_id, $user_id, $start_date, $end_date) {
                $q->when(auth('admin')->user()->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', auth('admin')->user()->branch_id)))
                    ->when($branch_id, fn($q) => $q->where('branch_id', $branch_id))
                    ->when($user_id, fn($q) => $q->where('user_id', $user_id))
                    ->when($start_date && $end_date, fn($q) => $q->whereBetween('created_at', [$start_date, $end_date]));
            })->sum('amount'), 2
        );

        // Count of users and total hours from attendance records
        $user_count = $query->count();
        $hours_count = Attendance::query()
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->when($start_date && $end_date, fn($q) => $q->whereBetween('created_at', [$start_date, $end_date]))
            ->sum('hours');

        // Prepare response data
        $response['data'] = [
            'user_count' => $user_count,
            'total_employment_contracts' => $total_employment_contracts,
            'total_financial_transactions' => $total_financial_transactions,
            'hours_count' => $hours_count // Total hours worked
        ];

        return response()->json($response);
    }


//    public function getData(Request $request)
//    {
//        $admin = auth('admin')->user();
//        $user_id = $request->user_id ?? false;
//
//        // Set start and end date
//        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') :null;
//        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
//
//        $branch_id = $request->branch_id ?? false;
//
//        // Query for attendance data, summing up the total attendance time for each user within the date range
//        $attendanceSummary = DB::table('attendances as a')
//            ->select(
//                'a.user_id',
//                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.login_time, a.logout_time)) as total_minutes') // Sum total minutes worked per user
//            )
//            ->when($start_date &&$end_date,function ($q)use ($start_date,$end_date){
//                $q->whereBetween('a.date', [$start_date, $end_date]);
//
//            })
//            ->groupBy('a.user_id');
//
//        // Main query for users, including their total attendance time via a left join
//        $query = User::query()
//            ->leftJoinSub($attendanceSummary, 'attendance_summary', function ($join) {
//                $join->on('users.id', '=', 'attendance_summary.user_id');
//            })
//            ->when($branch_id, function ($q) use ($branch_id) {
//                $q->whereHas('branch', function ($q) use ($branch_id) {
//                    $q->where('id', $branch_id);
//                });
//            })
//            ->when(!$admin->is_supper, function ($q) use ($admin) {
//                $q->whereHas('branch', function ($q) use ($admin) {
//                    $q->where('id', $admin->branch_id);
//                });
//            })
//            ->where('status', '=', 1) // Only active users
//            ->when($user_id, function ($query) use ($user_id) {
//                $query->whereIn('users.id', (array) $user_id);
//            });
//
//        // Total employment contracts and financial transactions
//        $total_employment_contracts = number_format(
//
//            jobContract::query()->wherehas('user',function($q)use($branch_id,$user_id,$start_date,$end_date){
//
//            $q->when(!auth('admin')->user()->is_supper, function ($q) {
//                $q->whereHas('branch', function ($q)  {
//                    $q->where('id', auth('admin')->user()->branch_id);
//                });
//            })
//
//
//                ->when($branch_id,function($q)use ($branch_id){
//                    $q->where('branch_id',$branch_id);
//                });
//            $q->when($user_id,function($q)use ($user_id){
//                $q->where('user_id',$user_id);
//            })
//            ->when($start_date&&$end_date,function ($q)use($start_date,$end_date){
//
//                    $q->whereBetween('created_at', [$start_date, $end_date]);
//
//                });
//            ;
//        })->sum('sallary'), 2);
//        $total_financial_transactions = number_format(IncomeMovement::query()
//            ->wherehas('user',function($q)use($branch_id,$admin,$user_id,$start_date,$end_date){
//
//                $q->when(!auth('admin')->user()->is_supper, function ($q)  {
//                    $q->whereHas('branch', function ($q)  {
//                        $q->where('id', auth('admin')->user()->branch_id);
//                    });
//                })
//
//
//                ->when($branch_id,function($q)use ($branch_id){
//                    $q->where('branch_id',$branch_id);
//                })->when($user_id,function($q)use ($user_id){
//                    $q->where('user_id',$user_id);
//                })->when($start_date&&$end_date,function ($q)use($start_date,$end_date){
//
//                    $q->whereBetween('created_at', [$start_date, $end_date]);
//
//                });
//            })
//            ->sum('amount'), 2);
//        // Total user count
//        $user_count = $query->count();
//        $hours_count=Attendance::query()->when($user_id,function ($q)use($user_id){
//            $q->where('user_id',$user_id);
//        })->when($start_date&&$end_date,function ($q)use($start_date,$end_date){
//
//            $q->whereBetween('created_at', [$start_date, $end_date]);
//
//        })->sum('hours');
//
//        $response['data'] = [
//            'user_count' => $user_count,
//            'total_employment_contracts' => $total_employment_contracts,
//            'total_financial_transactions' => $total_financial_transactions,
//            'hours_count' => $hours_count // Add total hours count
//        ];
//
//        return response()->json($response);
//    }


}
