<?php

namespace App\Http\Controllers\Admin\JoinBranches;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\JoinBranch;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JoinBranchController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->get();
        $data['branches'] = Branch::query()->get();
        return view('admin.joinBranches.index', $data);
    }
    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? false;

        $data = JoinBranch::query()
            ->orderby('id', 'desc')
            ->when($search, function ($q) use ($search) {
                $q->wherehas('users', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')->orwhere('mobile', 'like', '%' . $search . '%');
                });
            })

            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })

            ->when($request->user_id, function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });


        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
                return '<a href="' . route('admin.users.views', $data->user_id ?? '') . '"><img src="' . $data->users?->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
            })
            ->addColumn('name', function ($row) {
                return $row->users?->name;
            })

            ->addColumn('current_branch', function ($row) {
                return $row->users?->branch?->name ?? 'عضو جديد في طاقات';
            })
            ->addColumn('branch', function ($row) {
                return $row->branch?->name ?? '';
            })


            ->addColumn('action', function ($data) {


                return view('admin.joinBranches.partials.actions', compact('data'));


            })
            ->rawColumns(['action', 'photo'])
            ->make(true);
    }

    public function update(Request $request)
    {
        try {

            User::query()->where('id', $request->user_id)
                ->update([
                    'branch_id' => $request->branch_id,
                    'status' => 1,
                ]);
            JoinBranch::query()->where('user_id', $request->user_id)->where('branch_id', $request->branch_id)->delete();

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }




    public function delete(Request $request)
    {
        try {

            JoinBranch::query()->where('id', $request->id)->delete();

            return response_web(true, __('label.success_full_process'), [], 201);
        } catch (\Exception $ex) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
}
