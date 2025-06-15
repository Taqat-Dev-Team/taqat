<?php

namespace App\Http\Controllers\Admin\Generators;

use App\Http\Controllers\Controller;
use App\Models\Generator;
use App\Models\GeneratorExpense;
use Illuminate\Http\Request;

class ExpenseGeneratorContoller extends Controller
{

    public function index()
    {
        $data['generators'] = Generator::query()->get();
        return view('admin.generatorExpenses.index', $data);
    }
    public function getIndex(Request $request)
    {
        $generatorId = $request->generator_id;

        $query = GeneratorExpense::query()
            ->orderBy('created_at', 'desc');


        if ($request->filled('generator_id')) {
            $query->where('generator_id', $request->generator_id);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }


        return datatables()->of($query)
            ->addColumn('action', function ($data) {
                return view('admin.generatorExpenses.partials.actions', compact('data'));
            })
            ->addColumn('generator', function ($data) {
                return $data->generators?->name;
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        GeneratorExpense::query()->create([
            'title' => $request->title,
            'total_amount' => $request->total_amount,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'cash_paid' => $request->cash_paid,
            'bank_paid' => $request->bank_paid,
            'generator_id' => $request->generator_id,
            'date' => $request->date,

        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {
        $expense = GeneratorExpense::query()->where('id', $request->expense_id)->first();

        if ($expense) {
            $expense->update([
                'title' => $request->title,
                'total_amount' => $request->total_amount,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'cash_paid' => $request->cash_paid,
                'bank_paid' => $request->bank_paid,
                'generator_id' => $request->generator_id,
                'date' => $request->date,

            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
    public function exportExcel(Request $request)
    {
        $query = GeneratorExpense::query();

        if ($request->filled('generator_id')) {
            $query->where('generator_id', $request->generator_id);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $expenses = $query->orderBy('created_at', 'desc')->get();

        $filename = 'generator_expenses_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'ID',
            'Title',
            'Total Amount',
            'Price',
            'Quantity',
            'Cash Paid',
            'Bank Paid',
            'Generator',
            'Date',
            'Created At'
        ];

        $callback = function () use ($expenses, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($expenses as $expense) {
                fputcsv($file, [
                    $expense->id,
                    $expense->title,
                    $expense->total_amount,
                    $expense->price,
                    $expense->quantity,
                    $expense->cash_paid,
                    $expense->bank_paid,
                    optional($expense->generators)->name,
                    $expense->date,
                    $expense->created_at,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function delete(Request $request)
    {
        GeneratorExpense::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
