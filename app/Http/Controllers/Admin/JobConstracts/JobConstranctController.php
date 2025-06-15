<?php
namespace App\Http\Controllers\Admin\JobConstracts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobContractRequest; // Adjust according to your actual request class
use App\Models\jobContract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;

class JobConstranctController extends Controller
{
    public function index()
    {
        return view('admin.jobConstrancts.index');
    }

    public function getIndex(Request $request)
    {
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
        $user_type = $request->user_type > 0 ? $request->user_type : null;
        $admin = auth('admin')->user();

        // Dynamic ordering
        $order_column_index = $request->input('order.0.column'); // Column index from the request
        $order_direction = $request->input('order.0.dir'); // Sort direction (asc/desc)
        $columns = [
            'users.name',  // Name column from the related users table
            'job_contracts.sallary', // Adjust if you have an amount column in jobContracts
            'job_contracts.date'  // Adjust for the date column in jobContracts
        ];
        $order_column = $columns[$order_column_index] ?? 'job_contracts.created_at'; // Fallback to 'created_at' if the index is invalid

        $data = jobContract::query()
            ->join('users', 'users.id', '=', 'job_contracts.user_id') // Join with the users table
            ->whereHas('user', function ($q) use ($admin) {
                $q->when($admin->branch_id, function ($q) use ($admin) {
                    $q->whereHas('branch', function ($q) use ($admin) {
                        $q->where('id', $admin->branch_id);
                    });
                });
            })
            ->when($start_date && $end_date, fn($q) => $q->whereBetween('job_contracts.date', [$start_date, $end_date]))
            ->when($user_type, fn($q) => $q->whereHas('user', fn($q) => $q->where('status', $user_type)))
            ->orderBy($order_column, $order_direction) // Apply dynamic ordering
            ->select('job_contracts.*', 'users.name as user_name'); // Select necessary columns

        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
                $attachments = $data->getAttachment();
                $extension = pathinfo($attachments, PATHINFO_EXTENSION);

                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return '<a href="' . $attachments . '" target="_blank"><img src="' . $attachments . '" class="img-thumbnail img-preview" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" alt=""></a>';
                }

                if ($extension === 'pdf') {
                    return '<a href="' . $attachments . '" target="_blank"><i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius:50%;font-size:70px;color:red;"></i></a>';
                }

                return '<img src="' . asset('assets/default.png') . '" class="img-thumbnail img-preview" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" alt="">';
            })
            ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d'))
            ->addColumn('branch_name', fn($data) => $data->user->branch->name??'')

            ->addColumn('name', fn($data) => '<a href="' . route('admin.users.views', $data->user_id) . '">' . ($data->user_name ?: '-') . '</a>')
            ->addColumn('action', function ($data) {
                $editButton = null;
                $deleteButton = null;

                if (auth('admin')->user()->can('edit_job_constrancts')) {
                    $editButton = '<a href="' . route('admin.jobConstrancts.edit', $data->id) . '" ><span><i style="color:blue" class="fas fa-edit"></i></span></a>';
                }

                if (auth('admin')->user()->can('delete_job_constrancts')) {
                    $deleteButton = '<a id="' . $data->id . '" name_delete="' . $data->company_name . '" class="delete"><span><i style="color:red" class="fas fa-trash-alt"></i></span></a>';
                }

                return $editButton . '&nbsp;&nbsp;&nbsp;&nbsp;' . $deleteButton;
            })
            ->rawColumns(['photo', 'name', 'action'])
            ->make(true);

    }

    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }
            jobContract::query()->create([
                'company_name' => $request->company_name,
                'user_id' => $request->user_id,
                'sallary' => $request->sallary,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'photo' =>  url('/').'/public/files/'.$photo,
                'note' => $request->description??'',
                'job_type' => $request->job_type,
                'duration' => $request->duration,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }


    public function edit($id)
    {
        $data['jobContract'] = jobContract::findOrFail($id);
        return view('admin.jobConstrancts.edit', $data);
    }

    public function update(Request $request)
    {
        try {
            $job_contract = jobContract::findOrFail($request->job_construct_id);

            if ($request->hasFile('photo')) {
                $photo = upload($request->photo);
                $job_contract->update([

                    'photo' =>  url('/').'/public/files/'.$photo,


                ]);
            }

            $job_contract->update([
                'company_name' => $request->company_name,
                'sallary' => $request->sallary,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'note' => $request->note,
                'duration' => $request->duration,
                'job_type' => $request->job_type,
            ]);

            activity()
                ->performedOn($job_contract)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Job contract updated');

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $job_contract = jobContract::findOrFail($request->id);
            $job_contract->delete();

            activity()
                ->performedOn($job_contract)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Job contract deleted');

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function getData(Request $request)
    {
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
        $user_type = $request->user_type > 0 ? $request->user_type : null;
        $admin=auth('admin')->user();
        $contracts = jobContract::query()
        ->wherehas('user',function($q) use($admin){
            $q ->when($admin->branch_id,function($q) use($admin){
                $q->wherehas('branch',function($q)use($admin){
                    $q->where('id', $admin->branch_id);
                });
            });
        })
            ->when($start_date && $end_date, fn($q) => $q->whereBetween('date', [$start_date, $end_date]))
            ->when($user_type, fn($q) => $q->whereHas('user', fn($q) => $q->where('status', $user_type)))
            ->orderBy('created_at', 'desc');

        $user_count=User::query()
                         ->when($admin->branch_id,function($q) use($admin){
                            $q->wherehas('branch',function($q)use($admin){
                                $q->where('id', $admin->branch_id);
                            });
                        })

            ->whereHas('jobContracts')->count();
        $response['data'] = [
            'count_user' => $user_count,

            'count_contracts' => $contracts->count(),
            'min_contracts' => $contracts->min('sallary') ?? 0,
            'total_contracts' => $contracts->sum('sallary'),
            'max_contracts' => $contracts->max('sallary') ?? 0,
        ];

        return response_web(true, 'تم تنفيذ العملية بنجاح', $response, 201);
    }
}
