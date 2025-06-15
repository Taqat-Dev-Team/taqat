<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin.index');
    }

   

    public function home()
    {
        $data['expirationInvoices'] = Invoice::query()->whereDate('expiration_date', '>', Carbon::today())->where('status', '<>', 1)->get();
        return view('admin.home', $data);
    }
    public function getIndex(Request $request)
    {

        $data = Admin::query()->orderBy('created_at', 'desc');

        // Filtering logic
        if ($email = $request->input('email')) {
            $data->where("email", 'LIKE', '%' . $email . '%');
        }

        if ($name = $request->input('name')) {
            $data->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($mobile = $request->input('mobile')) {
            $data->where('mobile', 'LIKE', '%' . $mobile . '%');
        }

        if ($status = $request->input('status')) {
            $data->where('status', '=', $status == 1 ? 1 : 0);
        }

        if ($startDate = $request->input('start_date')) {
            $data->where('created_at', '>=', Carbon::parse($startDate));
        }

        if ($endDate = $request->input('end_date')) {
            $data->where('created_at', '<=', Carbon::parse($endDate));
        }

        // Dynamic ordering
        if ($request->has('order') && $request->has('columns')) {
            $orderColumnIndex = $request->input('order.0.column'); // Get column index
            $orderDirection = $request->input('order.0.dir', 'asc'); // Get order direction (asc/desc), default to 'asc'
            $orderColumn = $request->input("columns.$orderColumnIndex.data"); // Get the column name

            // Ensure the order column is valid to avoid SQL injection
            $validColumns = ['name', 'email', 'mobile', 'status', 'created_at'];
            if (in_array($orderColumn, $validColumns)) {
                $data->orderBy($orderColumn, $orderDirection);
            }
        }

        return DataTables::of($data)
            ->addColumn('role', fn($data) => $data->role ? $data->role->name : '')
            ->addColumn('branches', fn($data) => $data->branches ? $data->branches->name : '')
            ->addColumn('image', fn($data) => $data->getAttachment())
            ->addColumn('status', fn($data) => $this->getStatusColumn($data))
            ->addColumn('action', fn($data) => view('admin.admin.partials.actions', compact('data'))->render())
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }
    private function getStatusColumn($data)
    {
        $button = '';
        $checked = $data->status ? 'checked="checked"' : '';
        $button = '<span class="switch switch-icon">
                        <label>
                            <input type="checkbox" ' . $checked . ' name="status" data-id="' . $data->id . '" data-status="' . $data->status . '" class="check_status" />
                            <span></span>
                        </label>
                   </span>';
        return $button;
    }





    public function create()
    {
        $data['roles'] = Role::get();
        $data['branches'] = Branch::query()->get();

        return view('admin.admin.add', $data);
    }

    public function store(AdminRequest $request)
    {
        try {
            $image = $request->image ? upload($request->image) : null;

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role_id' => $request->role_id,
                'status' => $request->status ?? 0,
                'password' => Hash::make($request->password),
                'branch_id' => $request->branch_id,
                'image' => $image,
                'redirect_route' => $request->redirect_route ?? null,
            ]);

            // Log the activity
            activity()
                ->performedOn($admin)
                ->causedBy(auth()->user())
                ->log('Created a new admin');

            return response()->json([
                "status" => 201,
                'message' => 'تم إضافة المدير بنجاح',
                'redirect_url' => route('admin.admins.index')
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "status" => 422,
                'message' => 'لم يتم إضافة المدير بنجاح'
            ]);
        }
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        $data['branches'] = Branch::query()->get();
        $data['admin'] = $admin;
        $data['roles'] = Role::get();

        return view('admin.admin.edit', $data);
    }

    public function update(AdminRequest $request)
    {
        try {
            $admin = Admin::find($request->id);

            $oldData = $admin->toArray();

            if ($request->image) {
                $image = upload($request->image);
                $admin->update([
                    'image' => $image,
                ]);
            }

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role_id' => $request->role_id,
                'status' => $request->status ?? 0,
                'password' => $request->password ? Hash::make($request->password) : $admin->password,
                'branch_id' => $request->branch_id,
                'redirect_route' => $request->redirect_route ?? null,

            ]);

            // Log the activity
            activity()
                ->performedOn($admin)
                ->causedBy(auth()->user())
                ->withProperties([
                    'old' => $oldData,
                    'new' => $admin->toArray(),
                ])
                ->log('Updated admin');

            return response()->json([
                "status" => 201,
                'message' => 'تم تعديل المدير بنجاح',
                'redirect_url' => route('admin.admins.index')
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "status" => 422,
                'message' => 'لم يتم تعديل المدير بنجاح'
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $admin = Admin::findOrFail($request->id);
            $oldStatus = $admin->status;
            $admin->update(['status' => intval($request->status)]);

            // Log the activity
            activity()
                ->performedOn($admin)
                ->causedBy(auth()->user())
                ->withProperties([
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                ])
                ->log('Updated admin status');

            return response()->json([
                "status" => 201,
                'message' => 'تم تغير الحالة بنجاح'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json([
                "status" => 404,
                'message' => 'هذا الشخص غير موجود'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => 500,
                'message' => 'هناك خطأ ما، يرجى المحاولة لاحقاً'
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $admin = Admin::findOrFail($request->id);
            $admin->delete();

            // Log the activity
            activity()
                ->performedOn($admin)
                ->causedBy(auth()->user())
                ->log('Deleted an admin');

            return response()->json([
                "status" => 201,
                'message' => 'تم حذف مدير النظام بنجاح'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json([
                "status" => 404,
                'message' => 'مدير النظام غير موجود'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => 422,
                'message' => 'هناك خطأ ما، يرجى المحاولة لاحقاً'
            ]);
        }
    }
}
