<?php

namespace App\Http\Controllers\Admin\Expenses;

use App\Exports\ExpensesExport;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\Expense;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Expensecontoller extends Controller
{
    public  function  index()
    {

        $data['users'] = User::query()->where('user_type_cd_id', 65)

            ->get();


        $data['paymentTypes'] = Account::query()->where('parent_id', 7)->get();
        $data['currencies'] = Constant::query()->where('key', 'currency')->get();
        $data['expenses'] = Account::query()->where('type_id', 2)->get();
        return view('admin.expenses.index', $data);
    }


    public function getIndex(Request $request)
    {
        $user_id = $request->user_id;

        $expensesQuery = Expense::query()
            ->when($user_id, function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

        // حساب إجمالي المصروفات والمدفوعات
        $total_expense = $expensesQuery->sum('amount');
        $total_payment = $expensesQuery->where('status', 'paid')->sum('amount');


        if ($request->user_id) {
            $expensesQuery->where('user_id', $request->user_id);
        }

        if ($request->start_date) {
            $expensesQuery->whereDate('start_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $expensesQuery->whereDate('end_date', '<=', $request->end_date);
        }

        // جلب قائمة المصروفات فقط (لتكون قابلة للعرض في DataTables)
        $expenses = $expensesQuery->get();

        return DataTables::of($expenses)
            ->with([
                'total_expense' => number_format($total_expense, 2),
                'total_payment' => number_format($total_payment, 2)
            ])
            ->editColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->editColumn('payment_types', function ($data) {
                return $data->paymentTypes?->name;
            })
            ->addColumn('action', function ($data) {
                return view('admin.expenses.partials.actions', compact('data'));
            })

            ->make(true);
    }
    public function exportExcel(Request $request)
    {
        $query = Expense::query()
            ->with(['users', 'paymentTypes']);

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->start_date) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('end_date', '<=', $request->end_date);
        }

        $expenses = $query->get();

        return Excel::download(new ExpensesExport($expenses), 'expenses_filtered.xlsx');
    }


    // Helper function for generating action buttons





    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency_cd_id' => 'required',
            'account_id' => 'required|exists:accounts,id',
            'child_account_id' => 'required|exists:accounts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_method_id' => 'required',
        ]);


        $expense = Expense::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'currency_cd_id' => $validatedData['currency_cd_id'],
            'account_id' => $validatedData['account_id'],
            'child_account_id' => $validatedData['child_account_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'payment_method_id' => $validatedData['payment_method_id']
        ]);



        Transaction::query()->updateOrCreate([
            'expense_id' => $expense->id,

        ], [
            'date' => today(),
            'amount' => $request->amount,
            'form_account_id' => $validatedData['payment_method_id'],
            'to_account_id' =>  $validatedData['user_id'],
            'balance_type_id' => 8,
        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.expense_added_successfully'),
            'data' => $expense
        ]);
    }



    public  function  update(Request $request)
    {


        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency_cd_id' => 'required|exists:constants,id',
            'account_id' => 'required|exists:accounts,id',
            'child_account_id' => 'required|exists:accounts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_method_id' => 'required',
        ]);

        $expense = Expense::findOrFail($request->expense_id);
        $expense->update([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'currency_cd_id' => $validatedData['currency_cd_id'],
            'account_id' => $validatedData['account_id'],
            'child_account_id' => $validatedData['child_account_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'payment_method_id' => $validatedData['payment_method_id']
        ]);




        Transaction::query()->updateOrCreate([
            'expense_id' => $expense->id,

        ], [
            'date' => today(),
            'amount' => $request->amount,
            'form_account_id' => $validatedData['payment_method_id'],
            'to_account_id' =>  $validatedData['user_id'],
            'balance_type_id' => 8,
        ]);

        return response_web(true, 'نجاح العملية', [], 201);
    }



    public function delete(Request $request)
    {

        Expense::query()->where('id', $request->id)->delete();
        return response_web(true, 'نجاح العملية', [], 201);
    }
}
