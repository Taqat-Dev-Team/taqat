<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Constant;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class TreeController extends Controller
{

    public function tree()
    {

        $data['balanceTypes'] = Constant::query()->where('category', 'like', 'balance_types')->get();
        $data['accounts'] = Account::with('children')->where('parent_id', null)->get();
        return view('admin.accounts.tree.index', $data);
    }

    public function store(Request $request)
    {


        $lastParent = Account::whereNull('parent_id')->orderBy('code', 'desc')->first();
        $newCode = $lastParent ? $lastParent->code + 10000 : 10000;

        Account::create([
            'name' => $request->name,
            'code' => $request->code,
            'type_id' => $lastParent?->type_id + 1,
            'balance_type_id' => $request->balance_type_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الحساب بنجاح',
        ]);
    }

    public function storeChild(Request $request)
    {
        // جلب آخر عنصر مضاف بنفس parent_id
        $parent = Account::find($request->parent_id);

        $lastChild = Account::where('parent_id', $parent->id)
            ->orderBy('code', 'desc')
            ->first();
        $lastChild = Account::where('parent_id', $request->parent_id)->orderBy('code', 'desc')->first();
        // if (is_null($parent->parent_id)) {
        //     // الأب لا يملك أب (رئيسي)
        //     if ($lastChild) {

        //         $newCode = $lastChild->code + 1000;
        //     } else {
        //         $mainPrefix = intval(substr($parent->code, 0, 2)); // 40
        //         $newCode = ($mainPrefix + 1) * 1000; // 41 * 1000 = 41000
        //     }
        // } else {
        //     // الأب له أب
        //     if ($lastChild) {
        //         $newCode = $lastChild->code + 1;

        //     } else {
        //         $newCode = ($parent->code ) + 1;

        //     }
        // }

        // if (is_null($parent->parent_id)) {
        //     // رئيسي
        //     if ($lastChild) {
        //         $newCode = $lastChild->code + 1000;
        //     } else {
        //         $mainPrefix = intval(substr($parent->code, 0, 2)); // أول رقمين
        //         $newCode = ($mainPrefix + 1) * 1000;
        //     }
        // } else {
        //     // فرعي
        //     $newCode = $lastChild ? $lastChild->code + 1 : ($parent->code * 10) + 1;
        // }


        // dd('test');
        Account::create([
            'name' => $request->name,
            'code' => $request->code,
            'parent_id' => $request->parent_id,
            'type_id' => $parent?->type_id,
            'balance_type_id' => $request->balance_type_id
        ]);
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الحساب بنجاح',
        ]);
    }

    public function getAccountChildCode(Request $request)
    {
        $parent = Account::find($request->parentId);

        $lastChild = Account::where('parent_id', $parent->id)
            ->orderBy('code', 'desc')
            ->first();


        if (is_null($parent->parent_id)) {
            // رئيسي
            if ($lastChild) {
                $newCode = $lastChild->code + 1000;
            } else {
                $mainPrefix = intval(substr($parent->code, 0, 2)); // أول رقمين
                $newCode = ($mainPrefix + 1) * 1000;
            }
        } else {
            // فرعي
            $newCode = $lastChild ? $lastChild->code + 1 : ($parent->code * 10) + 1;
        }


        return response()->json([
            'success' => true,
            'new_code' => $newCode,
        ]);
    }
    public function getAccountCode(Request $request)
    {
        $lastParent = Account::whereNull('parent_id')->orderBy('code', 'desc')->first();
        $newCode = $lastParent ? $lastParent->code + 10000 : 10000;
        return response()->json([
            'success' => true,
            'new_code' => $newCode,
        ]);
    }


    public function pdf(Request $request)
    {
        // استرجاع الحساب بناءً على ID
        $account = Account::with(['formTransactions', 'toTransactions'])
            ->find($request->account_id);

            // dd($account);
        // جمع المعاملات من الحسابات (من و إلى) بشكل منفصل
        $formTransactions = $account->formTransactions()->orderBy('created_at', 'asc')->get();
        $toTransactions = $account->toTransactions()->orderBy('created_at', 'asc')->get();
        // dd($toTransactions);

        // دمج المعاملات معاً
        $transactions = $formTransactions->merge($toTransactions);

        // ترتيب المعاملات حسب التاريخ
        $transactions = $transactions->sortBy('created_at');

        // متغيرات لتخزين المدين والدائن والرصد الحالي
        $totalDebit = 0;
        $totalCredit = 0;
        $netBalance = 0;

        // جمع المعاملات وتحديث الرصيد
        $transactionDetails = [];
        foreach ($transactions as $transaction) {
            if ($transaction->balance_type_id == 6) { // مدين
                $totalDebit += $transaction->amount;
                $netBalance -= $transaction->amount;
            } elseif ($transaction->balance_type_id == 7) { // دائن
                $totalCredit += $transaction->amount;
                $netBalance += $transaction->amount;
            }

            // استرجاع اسم الحساب المرتبط بالمعاملة
            $formAccountName = $transaction->formAccount ? $transaction->formAccount->name : 'غير محدد';
            $toAccountName = $transaction->toAccount ? $transaction->toAccount->name : 'غير محدد';

            $transactionDetails[] = [
                'date' => $transaction->created_at->format('Y-m-d'),
                'form_account' => $formAccountName,
                'to_account' => $toAccountName,
                'debit' => $transaction->balance_type_id == 6 ? $transaction->amount : 0,
                'credit' => $transaction->balance_type_id == 7 ? $transaction->amount : 0,
                'current_balance' => $netBalance,
            ];
        }

        // إعداد المظهر (HTML)
        $html = view('admin.accounts.tree.pdf', compact('account','transactionDetails', 'totalDebit', 'totalCredit', 'netBalance'))->render();

        // إنشاء ملف PDF باستخدام mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // تنزيل أو عرض الـ PDF
        return $mpdf->Output('account_statement.pdf', 'I'); // 'I' لعرض الـ PDF في المتصفح
    }


}
