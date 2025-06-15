<?php
namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Companies\CompaniesRequest;
use App\Http\Requests\Admin\Compnies\CompaniesRequest as CompniesCompaniesRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.companies.index');
    }

    public function getIndex(Request $request)
    {
        $data = Company::query();

        // Dynamic ordering
        if ($request->has('order') && $request->has('columns')) {
            $orderColumnIndex = $request->input('order.0.column'); // Get column index
            $orderDirection = $request->input('order.0.dir', 'asc'); // Get order direction (asc/desc), default to 'asc'
            $orderColumn = $request->input("columns.$orderColumnIndex.data"); // Get the column name

            // Ensure the order column is valid to avoid SQL injection
            $validColumns = ['name', 'user_count', 'photo', 'created_at','user_name']; // Add valid columns here
            if (in_array($orderColumn, $validColumns)) {
                $data->orderBy($orderColumn, $orderDirection);
            } else {
                $data->orderBy('id', 'desc'); // Default ordering
            }
        } else {
            $data->orderBy('id', 'desc'); // Default ordering
        }

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)
            ->addColumn('user_count', fn($data) => '<a href="'.route('admin.users.index', ['company_id' => $data->id]).'">'.$data->userCount().'</a>')
            ->addColumn('photo', fn($data) => '<img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:50px;border-radius:50%;">')
            ->addColumn('action', function ($data) {
                $editButton = '<a href="' . route('admin.companies.edit', $data->id) . '"><span><i style="color:blue" class="fas fa-edit"></i></span></a>';
                $deleteButton = '<a id="' . $data->id . '" name_delete="' . $data->name . '" class="delete"><span><i style="color:red" class="fa fa-trash"></i></span></a>';
                return $editButton . '&nbsp;&nbsp;&nbsp;&nbsp;' . $deleteButton;
            })
            ->rawColumns(['photo', 'action', 'user_count'])
            ->make(true);
    }

    public function show($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('admin.users.view', $data);
    }

    public function create()
    {
        $data['users'] = User::all();
        return view('admin.companies.add', $data);
    }

    public function store(CompniesCompaniesRequest $request)
    {
        try {
            $photo = $request->hasFile('photo') ? upload($request->photo) : '';

            $company = Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_name' => $request->user_name,
                'photo' => $photo,
                'password' => Hash::make('123456')
            ]);

            if ($request->user_id) {
//                $company->users()->sync($request->user_id);

                User::whereIn('id', [$request->user_id])->update(['company_id' => $company->id]);
            }

            // Log the creation of a new company
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($company)
                ->withProperties(['name' => $request->name, 'email' => $request->email])
                ->log('Created a new company');

            return response_web(true, 'تم تنفيذ العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return response_web(false, 'لم يتم تنفيذ العملية بنجاح', [], 500);
        }
    }

    public function edit($id)
    {
        $data['company'] = Company::findOrFail($id);
        $data['users'] = User::all();

        return view('admin.companies.edit', $data);
    }

    public function update(Request $request)
    {
//        dd($request);
        try {
            $company = Company::findOrFail($request->company_id);

            if ($request->hasFile('photo')) {
                $photo = upload($request->photo);
                $company->update(['photo' => $photo]);
            }

            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_name' => $request->user_name,
            ]);


            if ($request->user_id) {
                User::query()->whereIn('id', $request->user_id)->update(['company_id' => $company->id]);
//                User::whereIn('id', [$request->user_id])->update(['company_id' => $company->id]);
            }else{
                User::whereIn('company_id', [$company->id])->update(['company_id' => null]);

            }
            // Log the update of a company
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($company)
                ->withProperties(['name' => $request->name, 'email' => $request->email])
                ->log('Updated company details');

            return response_web(true, 'تم تنفيذ العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return  $exception;
            return response_web(false, 'لم يتم تنفيذ العملية بنجاح', [], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $company = Company::findOrFail($request->id);
            $companyName = $company->name;
            $company->delete();

            // Log the deletion of a company
            activity()
                ->causedBy(auth('admin')->user())
                ->performedOn($company)
                ->withProperties(['company_id' => $request->id, 'name' => $companyName])
                ->log('Deleted a company');

            return response_web(true, 'تم تنفيذ العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return response_web(false, 'لم يتم تنفيذ العملية بنجاح', [], 500);
        }
    }
}
