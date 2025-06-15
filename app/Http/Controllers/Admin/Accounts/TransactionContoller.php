<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionContoller extends Controller
{

    public function index()
    {
        return view('admin.accounts.transactions.index');
    }

    public function getIndex(Request $request)
    {
        $data = Transaction::query()->with('balanceTypes');

        return datatables()->of($data)
        ->addColumn('form_account', function ($data) {
            return $data->formAccount?->name;
        })
        ->addColumn('to_account', function ($data) {
            return $data->toAccount?->name;
        })
        ->addColumn('to_account', function ($data) {
            return $data->toAccount?->name;
        })
        ->addColumn('balance_type', function ($data) {
            return $data->balanceTypes->value;
        })
        ->make(true);



    }

}
