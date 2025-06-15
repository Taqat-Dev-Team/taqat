<?php

namespace App\Http\Controllers\Admin\Accounts\Equites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounts\AccountRequest;
use App\Models\Account;
use App\Models\Constant;
use Illuminate\Http\Request;

class EquityController extends Controller
{
    public function index(){
        $data['assets']=Account::query()->with('balanceTypes')->where('type_id',5)->get();
        $data['balanceTypes']=Constant::query()->where('category','like','balance_types')->get();

        return view('admin.accounts.equities.index',$data);
    }

    public function getIndex(Request $request){
        $accounts = Account::query()->with('balanceTypes')->where('type_id',5)
        ->whereNotNull('parent_id')
        ;

        return datatables()->of($accounts)



            ->addColumn('parnent', function ($data) {
                return $data->parent?->name;
            })
            ->addColumn('action', function ($data) {


                return view('admin.accounts.equities.partials.actions',compact('data'));
            })
            ->rawColumns([ 'action'])
            ->make(true);
        return datatables()->of($accounts)->make(true);
    }


    public function store(AccountRequest $request)
    {
        // التحقق مما إذا كان هناك parent_id
        if ($request->parent_id) {
            // جلب آخر عنصر مضاف بنفس parent_id
            $lastChild = Account::where('parent_id', $request->parent_id)->orderBy('code', 'desc')->first();

            $parent_code=Account::where('id', $request->parent_id)->first();
            // إذا كان هناك عناصر بالفعل، نحصل على آخر كود ونزيده بـ 1، وإلا نبدأ من 10011
            $newCode = $lastChild ? $lastChild->code + 1 : ($parent_code->code * 10) + 1;


        } else {
            // جلب آخر عنصر رئيسي (بدون parent_id)
            $lastParent = Account::whereNull('parent_id')->orderBy('code', 'desc')->first();

            // إذا كان هناك عناصر رئيسية، نزيد على آخر كود، وإلا نبدأ من 1001
            $newCode = $lastParent ? $lastParent->code + 1 : 1001;
        }

        // إنشاء الحساب الجديد
        Account::create([
            'name' => $request->name,
            'code' => $newCode,
            'parent_id' => $request->parent_id,
            'type_id'=>5,
            'balance_type_id' => $request->balance_type_id
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function update(AccountRequest $request)
    {


        $account=Account::query()->where('id',$request->account_id)->first();
        // التحقق مما إذا كان هناك parent_id
        $newCode=$account->code;
        if ($request->parent_id !=$account->parent_id) {
            // جلب آخر عنصر مضاف بنفس parent_id
            $lastChild = Account::where('parent_id', $request->parent_id)->orderBy('code', 'desc')->first();
            $parent_code=Account::where('id', $request->parent_id)->first();
            // إذا كان هناك عناصر بالفعل، نحصل على آخر كود ونزيده بـ 1، وإلا نبدأ من 10011
            $newCode = $lastChild ? $lastChild->code + 1 : ($parent_code->code * 10) + 1;


        }

        // إنشاء الحساب الجديد
        $account->update([
            'name' => $request->name,
            'code' => $newCode,
            'parent_id' => $request->parent_id,
            'balance_type_id' => $request->balance_type_id
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }


    public function delete(Request $request){
        $account=Account::query()->where('id',$request->id)->delete();

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
}
