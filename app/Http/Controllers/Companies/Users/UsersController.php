<?php

namespace App\Http\Controllers\Companies\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\AddUserRequest;
use App\Models\Chat;
use App\Models\Company;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        $data['employee_count']=User::query()->where('company_id',auth('company')->id())->count();

        return view('companies.users.index',$data);
    }



    public function getIndex()
    {
        $data = User::query()
        ->with('companies')

        ->where('company_id',auth('company')->id())
            ->orderBy('id', 'desc');
        return DataTables::of($data)


            ->addColumn('name', function ($data) {
                return $data->name;

            })


            ->addColumn('company_name', function ($data) {
                return $data->companies?$data->companies->name:'-';

            })
            ->addColumn('photo', function ($data) {
                return '<a href=' . route('companies.users.views', $data->id) . '><img src="'.$data->getPhoto().'" class="circle" style="object-fit:contain;height:50px;width:50px;border-radius: 50%;"></a>';

            })
            ->addColumn('action', function ($data) {
                $button = '';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a href="' . route('companies.users.views', $data->id) . '"><span><i style="color: lightseagreen" class="fas fa-eye"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a href="' . route('companies.users.edit', $data->id) . '"><span><i style="color:bule" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a  id="' . $data->id . '" name_delete="' . $data->name . '" class="delete "><span><i  style="color: red" class="fa fa-trash"></i></span></button>';


                return $button;

            })->rawColumns(['photo','action'])
            ->make(true);
    }


    public function show($id)
    {
        $data['employee_count']=User::query()->where('company_id',auth('company')->id())->count();

        $data['user'] = User::query()->where('id', $id)->first() ?? abort(404);
        return view('companies.users.view', $data);

    }


    public function create(){
        $data['employee_count']=User::query()->where('company_id',auth('company')->id())->count();

        $data['specializations']=Specialization::query()->get();
        return view('companies.users.add',$data);
    }
    public function store(AddUserRequest $request){

        try{
            $photo="";
            if($request->hasFile('photo')){
             $photo=   upload($request->photo);


            }
        User::create([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'whatsapp'=>$request->whatsapp,
            'email'=>$request->email,
            'specialization_id'=>$request->specialization_id,
            'sallary'=>$request->sallary,
            'marital_status'=>$request->marital_status,
            'displacement_place'=>$request->displacement_place,
            'original_place'=>$request->original_place,
            'password'=>Hash::make('123456'),
             'status'=>3,
             'photo'=>url('/').'/public/files/'.$photo,
             'company_id'=>auth('company')->id()

        ]);

        return response()->json(["status" => 201, 'message' => __('label.success_full_process'),]);
    } catch (\Exception $ex) {
        return response()->json(["status" => 500, 'message' => __('label.error_server')]);
    }

    }
    public function edit($id)
    {
        $data['employee_count']=User::query()->where('company_id',auth('company')->id())->count();
        $data['specializations']=Specialization::query()->get();

        $data['user'] = User::query()->where('id', $id)->first() ?? abort(404);
        return view('companies.users.edit', $data);

    }


    public function delete(Request $request)
    {
        try {

            $user = User::query()->where('id', $request->id)->update([
                'company_id'=>null,
            ]);
            return response()->json(["status" => 201, 'message' => __('label.success_full_process'),]);
        } catch (\Exception $ex) {
            return response()->json(["status" => 500, 'message' => __('label.error_server')]);
        }

    }

    public function update(Request $request){

        try{


            $user=User::query()->where('id',$request->user_id)->first();
// Chat::query();
            $photo="";
            if($request->hasFile('photo')){
             $photo=   upload($request->photo);
             $user->update([
                'photo'=>url('/').'/public/files/'.$photo,
            ]);
            }

            $user->update([
                'name'=>$request->name,
                'mobile'=>$request->mobile,
                'whatsapp'=>$request->whatsapp,
                'email'=>$request->email,
                'specialization_id'=>$request->specialization_id,
                'sallary'=>$request->sallary,
                'marital_status'=>$request->marital_status,
                'displacement_place'=>$request->displacement_place,
                'original_place'=>$request->original_place,

            ]);


            return response()->json(["status" => 201, 'message' => __('label.success_full_process'),]);
        } catch (\Exception $ex) {
            return response()->json(["status" => 500, 'message' => __('label.error_server')]);
        }

    }




}
