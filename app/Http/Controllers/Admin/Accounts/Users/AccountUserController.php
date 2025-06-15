<?php

namespace App\Http\Controllers\Admin\Accounts\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounts\UserRequest;
use App\Models\Account;
use App\Models\City;
use App\Models\Constant;
use App\Models\User;
use Illuminate\Http\Request;

class AccountUserController extends Controller
{
    public function index(){
        $data['balanceTypes']=Constant::query()->where('category','like','balance_types')->get();

        $data['cities']=City::query()->get();
        return view('admin.accounts.users.index',$data);
    }

    public function getIndex(Request $request){
        $data = Account::query()->with('balanceTypes')->where('type_id',6)
        ->whereNotNull('parent_id');
        return datatables()->of($data)
            ->addColumn('parnent', function ($data) {
                return $data->parent?->name;
            })
            ->addColumn('action', function ($data) {
            return view('admin.accounts.users.partials.actions',compact('data'));
            })
            ->rawColumns([ 'action'])
            ->make(true);
    }


    public function store(UserRequest $request)
    {

            $lastChild = Account::where('parent_id', 1)->orderBy('code', 'desc')->first();
            $parent_code=Account::where('id', 1)->first();
            $newCode = $lastChild ? $lastChild->code + 1 : ($parent_code->code * 10) + 1;
        // إنشاء الحساب الجديد
        Account::create([
            'name' => $request->name,
            'code' => $newCode,
            'type_id'=>6,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'tel_phone'=>$request->tel_phone,
            'mobile' => $request->mobile,
            'fax_number'=>$request->fax_number,
            'parent_id'=>30,
            'balance_type_id' => $request->balance_type_id
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(UserRequest $request)
    {


        $account=Account::query()->where('id',$request->account_id)->first();


        // إنشاء الحساب الجديد
        $account->update([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'fax_number'=>$request->fax_number,
            'balance_type_id' => $request->balance_type_id
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request){
        $account=Account::query()->where('id',$request->id)->delete();

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function getUsersSerach(Request $request)
    {
        $query = $request->get('q', '');

        $users = User::query()
            ->where('name', 'like', '%' . $query . '%')
            ->get(['id', 'name']);

        return response()->json($users);
    }
}
