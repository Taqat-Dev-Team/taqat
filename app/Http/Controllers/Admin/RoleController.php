<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest as RoleRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log; // For general logging

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function getIndex(Request $request)
    {
        // Start the query on the Role model
        $data = Role::query();

        // Apply dynamic ordering based on request inputs
        if ($request->has('order') && $request->has('columns')) {
            // Get the index of the column to order by
            $orderColumnIndex = $request->input('order.0.column');
            // Get the direction of the ordering, default to ascending if not provided
            $orderDirection = $request->input('order.0.dir', 'asc');
            // Get the name of the column to order by
            $orderColumn = $request->input("columns.$orderColumnIndex.data");

            // Define a whitelist of valid columns that can be ordered by
            $validColumns = ['name', 'status', 'created_at'];

            // Check if the requested column is valid to avoid SQL injection
            if (in_array($orderColumn, $validColumns)) {
                // Apply the ordering to the query
                $data->orderBy($orderColumn, $orderDirection);
            } else {
                // Default ordering if the requested column is not valid
                $data->orderBy('created_at', 'desc');
            }
        } else {
            // Default ordering if no specific ordering is requested
            $data->orderBy('created_at', 'desc');
        }

        return DataTables::of($data)
            ->addColumn('status', function ($data) {
                return getStatusButton($data->status, $data->id);
            })
            ->addColumn('action', function ($data) {
                $button = '';
                $button .= '<a href="' . route('admin.roles.edit', $data->id) . '" class="edit_user">
                                <span><i style="color: #66afe9" class="fas fa-edit"></i></span>
                            </a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                return $button;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleRoleRequest $request)
    {
        try {
            $role = $this->process(new Role, $request);

            // Log the activity
            activity()
                ->performedOn($role)
                ->causedBy(auth()->user())
                ->log('Created a new role');

            return response()->json([
                "status" => 201,
                'message' => 'تم اضافة الصلاحية بنجاح',
                'redirect_url' => route('admin.roles.index')
            ]);
        } catch (\Exception $ex) {
            Log::error('Failed to create role: ' . $ex->getMessage());

            return response()->json([
                "status" => 422,
                'message' => 'لم يتم اضافة الصلاحية بنجاح'
            ]);
        }
    }

    public function edit($id)
    {
        $data['role'] = Role::findOrFail($id);
        return view('admin.roles.edit', $data);
    }

    public function update(RoleRoleRequest $request)
    {
        try {
            $role = Role::findOrFail($request->role_id);
            $oldData = $role->toArray();

            $role = $this->process($role, $request);

            // Log the activity
            activity()
                ->performedOn($role)
                ->causedBy(auth()->user())
                ->withProperties([
                    'old' => $oldData,
                    'new' => $role->toArray(),
                ])
                ->log('Updated a role');

            return response()->json([
                "status" => 201,
                'message' => 'تم التعديل بنجاح',
                'redirect_url' => route('admin.roles.index')
            ]);
        } catch (\Exception $ex) {
            Log::error('Failed to update role: ' . $ex->getMessage());

            return response()->json([
                "status" => 422,
                'message' => 'لم يتم تعديل الصلاحية بنجاح'
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);

            if ($role->admins()->count() > 0) {
                return response()->json([
                    "status" => 422,
                    'message' => 'لا يمكن تغير حالة الصلاحية بسبب استخدامها من قبل مديري النظام'
                ]);
            }

            $oldStatus = $role->status;
            $role->update([
                'status' => intval($request->status),
            ]);

            // Log the activity
            activity()
                ->performedOn($role)
                ->causedBy(auth()->user())
                ->withProperties([
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                ])
                ->log('Updated role status');

            return response()->json([
                "status" => 201,
                'message' => 'تم تغير الحالة بنجاح'
            ]);
        } catch (\Exception $exception) {
            Log::error('Failed to update role status: ' . $exception->getMessage());

            return response()->json([
                "status" => 500,
                'message' => 'هناك خطأ ما يرجى المحاولة لاحقاً'
            ]);
        }
    }

    protected function process(Role $role, Request $request)
    {
        $role->name = $request->name;
        $role->permissions = $request->permissions;
        $role->save();
        return $role;
    }
}

