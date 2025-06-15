<?php
namespace App\Http\Controllers\Admin\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Branch\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    // Display the branches list view
    public function index()
    {
        return view('admin.branchs.index');
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? null;

        $data = Branch::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name'); // Ordering by name

        return DataTables::of($data)
            ->addColumn('max_capacity', fn($data) => $data->MaxCapacity())
            ->addColumn('registered_count', fn($data) => $data->sumRegisteredCount())
            ->addColumn('user_count', fn($data) => $data->users()->count())
            ->addColumn('total_income', fn($data) => $data->totalIncomeMovements())
            ->addColumn('total_contracts', fn($data) => $data->totalJobContracts()) // Fixed typo: total_contrancts → total_contracts
            ->addColumn('branch_name', fn($data) => '<a href="' . route('admin.users.index', ['branch_id' => $data->id]) . '">' . e($data->name) . '</a>')
            ->addColumn('status', fn($data) => getStatusButton($data->status, $data->id))
            ->addColumn('action', fn($data) => view('admin.branchs.partials.actions', compact('data')))
            ->rawColumns(['action', 'status', 'branch_name'])
            ->make(true);
    }


    // Store a new branch
    public function store(BranchRequest $request)
    {
        try {
            $branch = Branch::query()->create([
                'name' => $request->name,
                'status' => $request->status ? 1 : 0,
                'code'=>$request->code
            ]);

            // Log the creation of a new branch
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($branch)
                ->withProperties(['name' => $request->name, 'status' => $request->status])
                ->log('Created a new branch');

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Update an existing branch
    public function update(BranchRequest $request)
    {
        try {
            $branch = Branch::query()->where('id', $request->branch_id)->first();
            $branch->update([
                'name' => $request->name,
                'status' => $request->status ? 1 : 0,
                'code'=>$request->code

            ]);







            // Log the update of a branch
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($branch)
                ->withProperties(['name' => $request->name, 'status' => $request->status])
                ->log('Updated branch details');

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Delete a branch
    public function delete(Request $request)
    {
        try {
            $branch = Branch::query()->where('id', $request->id)->first();
            $branchName = $branch->name;
            $branch->delete();

            // Log the deletion of a branch
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($branch)
                ->withProperties(['branch_id' => $request->id, 'name' => $branchName])
                ->log('Deleted a branch');

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Update the status of a branch
    public function updateStatus(Request $request)
    {
        try {
            $branch = Branch::query()->where('id', $request->id)->first();
            $branch->update([
                'status' => $request->status ? 1 : 0,
            ]);

            // Log the status update of a branch
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($branch)
                ->withProperties(['status' => $request->status])
                ->log('Updated branch status');

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
}
