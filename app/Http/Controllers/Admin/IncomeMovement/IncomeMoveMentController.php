<?php

namespace App\Http\Controllers\Admin\IncomeMovement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteIncommetMomveMentRequest;
use App\Http\Requests\Admin\IncomeMomveMentRequest;
use App\Models\IncomeMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;

class IncomeMovementController extends Controller
{
    public function index()
    {
        return view('admin.incomeMovements.index');
    }



    public function getIndex(Request $request)
{
    $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
    $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
    $user_type = $request->input('user_type') > 0 ? $request->input('user_type') : null;

    $admin = auth('admin')->user();
    $data = IncomeMovement::query()

        ->when($admin->branch_id, function($q) use($admin) {
            $q->whereHas('user', function($q) use ($admin) {
                $q->wherehas('branch',function($q) use($admin){
                    $q->where('id', $admin->branch_id);
                });
            });
        })
        ->when($start_date && $end_date, function($q) use ($start_date, $end_date) {
            $q->whereBetween('date', [$start_date, $end_date]);
        })
        ->when($user_type, function($q) use ($user_type) {
            $q->whereHas('user', function($q) use ($user_type) {
                $q->where('status', $user_type);
            });
        });

    // Handle dynamic ordering
    if ($request->has('order') && $request->has('columns')) {
        $orderColumnIndex = $request->input('order.0.column'); // Get column index
        $orderDirection = $request->input('order.0.dir', 'asc'); // Get order direction (asc/desc), default to 'asc'
        $orderColumn = $request->input("columns.$orderColumnIndex.data"); // Get the column name

        // Ensure the order column is valid to avoid SQL injection
        $validColumns = ['title', 'source', 'amount', 'date', 'created_at'];
        if (in_array($orderColumn, $validColumns)) {
            $data->orderBy($orderColumn, $orderDirection);
        }
    } else {
        $data->orderBy('created_at', 'desc'); // Default ordering
    }

    return DataTables::of($data)
        ->addColumn('attachment', function ($data) {
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
        ->addColumn('name', fn($data) => $data->user ? $data->user->name : '-')

        ->addColumn('amount', function ($data) {
            return $data->adjusted_amount;
                        })
        ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d'))

        ->addColumn('action', function ($data) {
            $editButton = auth('admin')->user()->can('edit_income_movements')
                ? '<a href="' . route('admin.incomeMovements.edit', $data->id) . '" class="edit_admin"><span><i style="color:blue" class="fas fa-edit"></i></span></a>'
                : '';

            $deleteButton = auth('admin')->user()->can('delete_income_movements')
                ? '<a id="' . $data->id . '" name_delete="' . $data->source . '" class="delete"><span><i style="color:red" class="fas fa-trash-alt"></i></span></a>'
                : '';

            return $editButton . '&nbsp;&nbsp;&nbsp;&nbsp;' . $deleteButton;
        })
        ->rawColumns(['attachment', 'action'])
        ->make(true);
}

    public function edit($id)
    {
        $data['incomeMovement'] = IncomeMovement::findOrFail($id);
        return view('admin.incomeMovements.edit', $data);
    }

    public function update(IncomeMomveMentRequest $request)
    {
        try {
            $incomeMovement = IncomeMovement::findOrFail($request->income_movement_id);

            if ($request->hasFile('photo')) {
                $photo = upload($request->photo);
                $incomeMovement->update(['photo' => $photo]);
            }

            $incomeMovement->update([
                'amount' => $request->amount,
                'source' => $request->source,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'note' => $request->note,
                'amount_type' => $request->amout_type,

            ]);

            activity()
                ->performedOn($incomeMovement)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Income movement updated');

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            // return $ex;

            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function delete(DeleteIncommetMomveMentRequest $request)
    {
        try {
            $incomeMovement = IncomeMovement::findOrFail($request->id);
            $incomeMovement->delete();

            activity()
                ->performedOn($incomeMovement)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log('Income movement deleted');

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

        $admin = auth('admin')->user();

        // Query with Scopes
        $incomeMovementQuery = IncomeMovement::query()
            ->filterByBranch($admin)
            ->filterByDateRange($start_date, $end_date)
            ->filterByUserType($user_type)
            ->orderBy('created_at', 'desc');

        // Fetch Data
        $response['data'] = [
            'count_income' => $incomeMovementQuery->count(),
            'min_income' => $incomeMovementQuery->minAdjustedIncome() ?? 0,
            'total_income' => number_format($incomeMovementQuery->sum('amount'), 2), // Sum is directly on 'amount'
            'max_income' => $incomeMovementQuery->maxAdjustedIncome() ?? 0,
        ];

        return response_web(true, __('label.success_full_process'), $response, 201);
    }


}
