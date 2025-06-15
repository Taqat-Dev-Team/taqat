<?php

namespace App\Http\Controllers\Admin\Generators;

use App\Exports\GeneratorSubscriptionsExport;
use App\Http\Controllers\Controller;
use App\Models\Generator;
use App\Models\GeneratorExpense;
use App\Models\GeneratorSubscription;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GeneratorController extends Controller
{
    public function index(Request $request)
    {

        $data['status'] = $request->status;
        return view('admin.generators.index', $data);
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? '';

        $generators = Generator::query()
            ->when($request->status, function ($q) {
                $q->onlyTrashed();
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderby('id', 'desc');

        return datatables()->of($generators)
            ->addColumn('name', function($data) {
                return $data->name ;
            })
            ->addColumn('subscribers_count', function($data) {
                return $data->subscribe_count;
            })
            ->addColumn('total_receipt', function($data) {
                return $data->total_receipts;
            })
            ->addColumn('total_expenses', function($data) {
                return $data->total_expenses;
            })
            ->addColumn('action', function ($data) {
                return view('admin.generators.partials.actions', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function store(Request $request)
    {

        Generator::create([
            'name' => $request->name,

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {


        $generator = Generator::query()->where('id', $request->generator_id)->first();
        $generator->update([
            'name' => $request->name,

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        Generator::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function exportExcel(Request $request)
    {
        $generatorId = $request->generator_id;

        $subscriptions =  GeneratorSubscription::query()
            ->where('generator_id', $generatorId);

        $fileName = 'generator_subscriptions.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return Excel::download(new GeneratorSubscriptionsExport($subscriptions), $fileName, null, $headers);
    }


    public function importExcel(Request $request)
    {
        $generatorId = $request->generator_id;
        $file = $request->file('excel_file');
        $filePath = $file->store('temp');
        $filePath = storage_path('app/' . $filePath);

        $data = Excel::toArray([], $filePath);

        // استخراج رؤوس الأعمدة من أول صف
        $headers = $data[0][0] ?? [];
        $rows = array_slice($data[0], 1);

        foreach ($rows as $row) {
            // تحويل الصف إلى مصفوفة ترابطية باستخدام رؤوس الأعمدة كمفاتيح
            $assocRow = array_combine($headers, $row);

            // تخطي الصف إذا كان فارغًا (مثلاً لا يوجد اسم أو رقم جوال)
            if (empty($assocRow['name']) && empty($assocRow['mobile'])) {
                continue;
            }

            GeneratorSubscription::create([
                'name' => $assocRow['name'],
                'mobile' => $assocRow['mobile'],
                'initial_reading' => $assocRow['initial_reading'] ?? 0,
                'killo_watt_cost' => $assocRow['killo_watt_cost'] ?? 0,
                'generator_id' => $generatorId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function restore(Request $request)
    {
        $generator = Generator::withTrashed()->findOrFail($request->restore_id);

        $generator->restore();

        return response()->json([
            'status' => true,
            'message' => 'تم استرجاع  بنجاح.'
        ]);
    }

    public function getgeneratorExpenses(Request $request)
    {
        $generatorId = $request->generator_id;

        $expenses = GeneratorExpense::query()
            ->where('generator_id', $generatorId)
            ->orderBy('created_at', 'desc');

        return datatables()->of($expenses)
            ->addColumn('action', function ($data) {
                return view('admin.generators.partials.expenses_actions', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeGeneratorExpenses(Request $request)
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

    public function updateGeneratorExpenses(Request $request)
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
                    'date' => $request->date,

            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
