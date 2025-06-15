<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Constant;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LogController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->get();
        $data['branches'] = Branch::get();
        $data['companies'] = Company::query()->get();
        $data['userTypes'] = Constant::query()->whereNotNull('parent_id')->where('key', 'user_types')->get();

        $data['currencies'] = Constant::query()->where('key', 'currency')->whereNotNull('parent_id')->get();

        return view('admin.logs.index', $data);
    }
    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? false;


        $data = Log::query()
            ->when($search, function ($q) use ($search) {

                $q->where('mobile', 'like', '%' . $search . '%')->orwhereHas('users', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })

            ->when($request->branch_id, function ($q) use ($request) {
                $branch = Branch::query()->where('id', $request->branch_id)->first();

                $q->where('ip_address', $branch?->ip_address);
            })
            ->when($request->date, function ($q) use ($request) {
                // $date = Carbon::createFromFormat('m/d/y', $request->date)->format('Y-m-d');
                $q->whereDate('date', $request->date);
            }, function ($q) {
                $q->whereDate('date', Carbon::now()->format('Y-m-d'));
            })
            ->when($request->user_id, function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            })
            ->when($request->user_type_cd_id, function ($q) use ($request) {
                $q->wherehas('users', function ($q) {
                    $q->where('user_type_cd_id', request()->user_type_cd_id);
                });
            });




        if ($request->order_by && $request->order_direction) {
            $orderBy = $request->order_by;
            $orderDirection = $request->order_direction;

            if (in_array($orderBy, ['name', 'hours']) && in_array($orderDirection, ['asc', 'desc'])) {
                if ($orderBy == 'name') {
                    $data = $data->join('users', 'logs.user_id', '=', 'users.id')
                        ->orderBy('users.name', $orderDirection);
                } elseif ($orderBy == 'hours') {
                    $data = $data->orderBy(DB::raw('TIMESTAMPDIFF(HOUR, time_in, time_out)'), $orderDirection);
                }
            } else {
                $data = $data->orderBy('user_id', 'asc');
            }
        } else {
            $data = $data->orderBy('user_id', 'asc');
        }
        $data = $data->get();


        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
                $photoUrl = $data->users?->getPhoto() ?? asset('assets/default.png');
                return '<a href="' . route('admin.users.views', $data->user_id ?? '') . '"><img src="' . $photoUrl . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
            })

            ->addColumn('name', function ($row) {
                return $row->users?->name;
            })
            ->addColumn('mobile', function ($row) {
                return $row->mobile;
            })

            ->addColumn('completed_invoice', function ($row) {
                return $row->users?->invoices?->where('status', 1)->sum('amount');
            })

            ->addColumn('pendding_invoice', function ($row) {
                return $row->users?->invoices?->where('status', 0)->sum('amount');
            })
            ->addColumn('branch', function ($row) {
                // return $row->ip_address;
                $branch = Branch::query()->where('ip_address', $row->ip_address)->first();

                return $branch?->name;
            })
            ->addColumn('time_in', function ($row) {
                return $row->time_in;
            })
            ->addColumn('time_out', function ($row) {
                return $row->time_out;
            })
            ->addColumn('hours', function ($row) {
                $timeIn = Carbon::parse($row->time_in);
                $timeOut = Carbon::parse($row->time_out);
                return $timeOut->diffInHours($timeIn) . ' ساعات ' . ':' . $timeOut->diffInMinutes($timeIn) % 60 . ' دقائق ';
            })

            ->addColumn('action', function ($data) {

                return view('admin.logs.partials.actions', compact('data'));
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
        $branch_id = $request->input('branch_id') ?? false;

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
            ->with(['logs' => function ($query) use ($date) {
                $query->where('date', $date)
                    ->orderBy('date', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->get();

        $user_count = $data->count();

        $absence_count = $data->filter(function ($user) use ($date) {
            return !$user->logs->where('date', $date)->count();
        })->count();

        $presence_count = $data->filter(function ($user) use ($date) {
            return $user->logs->where('date', $date)->count();
        })->count();

        $log_hours = Log::query()->when($date, function ($q) use ($date) {
            $q->where('date', $date);
        })->sum('duration') / 60;
        $response['data'] = [
            'user_count' => $user_count,
            'log_hours' => number_format($log_hours, 2),
            'absence_count' => $absence_count,
            'presence_count' => $presence_count,
        ];

        return response()->json($response);
    }

    public function delete(Request $request)
    {
        try {

            Log::query()->where('id', $request->id)->delete();
            return response()->json(["status" => 201, "message" => 'تمت عملية الحذف   بنجاح']);
        } catch (\Exception $exception) {
            return response()->json(["status" => 500, "message" => 'لم يتم تنفيد العملية بنجاح']);
        }
    }
}
