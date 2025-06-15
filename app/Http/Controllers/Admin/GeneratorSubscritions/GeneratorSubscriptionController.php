<?php

namespace App\Http\Controllers\Admin\GeneratorSubscritions;

use App\Http\Controllers\Controller;
use App\Models\Generator;
use App\Models\GeneratorExpense;
use App\Models\GeneratorReceipt;
use App\Models\GeneratorSubscription;
use App\Models\ReadingGenerator;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GeneratorSubscriptionController extends Controller
{
    protected  $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index(Request $request)
    {
        $data = [
            'status' => $request->status,
            'generators' => Generator::orderByDesc('id')->get(),
            'generatorSubsriptions' => GeneratorSubscription::orderByDesc('id')->get(),
            'total_subscribers' => GeneratorSubscription::count(),
            'total_monthly_readings' => round(
                ReadingGenerator::whereHas('generatorSubscriptions')
                    ->whereMonth('created_at', now()->month)
                    ->sum('consumption_quantity'),
                2
            ),
            'total_collections' => round(GeneratorReceipt::whereHas('generatorSubscriptions')->sum('amount'), 2),
            'total_debts' => round(
                ReadingGenerator::sum('consumption_value') - GeneratorReceipt::sum('amount'),
                2
            ),
        ];


        //        $data['generators'] = Generator::query()->get();
        return view('admin.generatorSubscriptions.index', $data);
    }



    public function search(Request $request)
    {
        $generatorId = $request->generator_id;

        // الحصول على معرفات الاشتراكات الخاصة بالمولد (إن وُجد)
        $subscriptionIds = GeneratorSubscription::when($generatorId, function ($query) use ($generatorId) {
            $query->where('generator_id', $generatorId);
        })->pluck('id');

        // الإحصائيات
        $totalSubscribers = $subscriptionIds->count();

        $totalMonthlyReadings = round(
            ReadingGenerator::whereIn('generator_subscription_id', $subscriptionIds)
                ->whereMonth('created_at', now()->month)
                ->sum('consumption_quantity'),
            2
        );

        $totalCollections = round(
            GeneratorReceipt::whereIn('generator_subscription_id', $subscriptionIds)->sum('amount'),
            2
        );

        $totalDebts = round(
            ReadingGenerator::whereIn('generator_subscription_id', $subscriptionIds)->sum('consumption_value') - $totalCollections,
            2
        );

           $total_expenses = round(
            GeneratorExpense::query()->sum('total_amount'),
            2
        );

        return response()->json([
            'total_subscribers'       => $totalSubscribers,
            // 'total_monthly_readings'  => $totalMonthlyReadings,
            'total_collections'       => $totalCollections,
            'total_expenses'             => $total_expenses,
            'total_debts'=>$totalDebts,
        ]);
    }


    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? '';

        $generatorSubscriptions = GeneratorSubscription::query()
            ->when($request->status, function ($q) {
                $q->onlyTrashed();
            })
            ->when($request->generator_id, function ($query) use ($request) {
                $query->where('generator_id', $request->generator_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('mobile', 'like', '%' . $search . '%');
            })
            ->orderby('id', 'desc');
        return datatables()->of($generatorSubscriptions)
            ->addColumn('action', function ($data) {
                return view('admin.generatorSubscriptions.partials.actions', compact('data'));
            })
            ->addColumn('current_reading', function ($data) {

                $lastReading = $data->readingGenerator()
                    ->where('generator_subscription_id', $data->id)
                    ->orderBy('id', 'desc')
                    ->first();

                return $lastReading ? $lastReading->current_reading : $data->initial_reading;
            })

            ->addColumn('remaining_amount', function ($data) {
                $generatorReceipt = $data->generatorReceipt()->sum('amount');
                $readingGenerator = $data->readingGenerator()->sum('consumption_value');
                $remaining_amount = $readingGenerator - $generatorReceipt;
                return round($remaining_amount, 2);
            })


            ->addColumn('generator', function ($data) {
                return $data->generator ? $data->generator->name : '';
            })



            ->addColumn('paid_amount', function ($data) {


                return    $generatorReceipt =   $data->generatorReceipt()->sum('amount');
            })

            ->rawColumns(['action'])
            ->make(true);
    }


    public function store(Request $request)
    {

        GeneratorSubscription::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'initial_reading' => $request->initial_reading,
            'killo_watt_cost' => $request->killo_watt_cost,
            'generator_id' => $request->generator_id,

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {


        $subscription = GeneratorSubscription::query()->where('id', $request->generator_subscription_id)->first();
        $subscription->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'initial_reading' => $request->initial_reading,
            'killo_watt_cost' => $request->killo_watt_cost,
            'generator_id' => $request->generator_id,

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        GeneratorSubscription::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function deletegeneratorExpenses(Request $request)
    {
        GeneratorExpense::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
    public function generatorReceipt(Request $request)
    {

        GeneratorReceipt::query()->create([
            'generator_subscription_id' => $request->generator_subscription_id,
            'amount' => $request->amount,
            'date' => $request->date,
        'cash_paid'=>$request->cash_paid,
                    'bank_paid'=>$request->bank_paid,

        ]);


        $generatorSubscriptions = GeneratorSubscription::query()->find($request->generator_subscription_id);

        $mobile = $generatorSubscriptions->mobile;
        if ($mobile && $request->send_sms) {
            $generatorReceipt =   GeneratorReceipt::query()->where('generator_subscription_id', $request->generator_subscription_id)->sum('amount');
            $readingGenerator =    ReadingGenerator::query()->where('generator_subscription_id', $request->generator_subscription_id)->sum('consumption_value');
            $remaining_amount = $readingGenerator - $generatorReceipt;
            $message = 'تم تحصيل مبلغ ' . $request->amount . ' شيكل متبقي  ' . ($remaining_amount) . ' شيكل.';
            $this->smsService->sendSMS($mobile, $message);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function getReceiptsGenerator(Request $request)
    {
        $search = $request->search['value'] ?? '';

        $generatorReceipt = GeneratorReceipt::query()
            ->where('generator_subscription_id', $request->generator_subscription_id)
            ->orderby('id', 'desc');
        return datatables()->of($generatorReceipt)
            ->addColumn('actions', function ($data) {
                return view('admin.generatorSubscriptions.partials.receiptActions', compact('data'));
            })

            ->rawColumns(['actions'])
            ->make(true);
    }


    public function calculateConsumptionValue(Request $request)
    {
        $generatorSubscriptions = GeneratorSubscription::query()->find($request->generator_subscription_id);

        $lastReading = ReadingGenerator::query()
            ->where('generator_subscription_id', $request->generator_subscription_id)
            ->orderBy('id', 'desc')
            ->first();



        if ($lastReading && $lastReading->id == $request->reading_id) {
            $lastReading = ReadingGenerator::query()
                ->where('generator_subscription_id', $request->generator_subscription_id)
                ->where('id', '<', $request->reading_id) // التأكد من أن القراءة السابقة لها id أصغر
                ->orderBy('id', 'desc') // ترتيب النتائج من الأحدث إلى الأقدم
                ->first();
        }


        $previousReading = $lastReading
            ? $lastReading->current_reading
            : ($generatorSubscriptions->initial_reading ?? 0);

        $current_reading = $request->current_reading;
        $consumption_quantity = $current_reading - $previousReading;

        // dd($consumption_quantity.''.$previousReading.''.$current_reading);
        $killo_watt_cost = $request->killo_watt_cost;
        $total_cost = $consumption_quantity * $killo_watt_cost;

        return response()->json([
            'success' => true,
            'consumption_quantity' => round($consumption_quantity, 2),
            'consumption_value' => round($total_cost, 2),
        ]);
    }

    public function sendSms(Request $request)
    {

        $generatorSubscriptions = GeneratorSubscription::query()->whereIn('id', $request->generator_subscription_id)->get();

        foreach ($generatorSubscriptions as $value) {
            $mobile = $value->mobile;
            if ($mobile) {

                $this->smsService->sendSMS($mobile, $request->message);
            }
        }


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function getReceiptData(Request $request)
    {
        $receipt = GeneratorReceipt::query()
            ->where('id', $request->receipt_id)
            ->first();

        if ($receipt) {
            return response()->json([
                'success' => true,
                'data' => [
                    'amount' => $receipt->amount,
                    'date' => $receipt->date,
                    'cash_paid'=>$receipt->cash_paid,
                    'bank_paid'=>$receipt->bank_paid,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('messages.Receipt not found'),
        ]);
    }

    public function updateReceipt(Request $request)
    {
        $receipt = GeneratorReceipt::query()->where('id', $request->receipt_id)->first();
        if ($receipt) {
            $receipt->update([
                'amount' => $request->amount,
                'date' => $request->date,
                   'cash_paid'=>$request->cash_paid,
                    'bank_paid'=>$request->bank_paid,

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => __('messages.Receipt not found'),
            ]);
        }


        $generatorSubscriptions = GeneratorSubscription::query()->find($receipt->generator_subscription_id);

        $mobile = $generatorSubscriptions->mobile;
        if ($mobile && $request->send_sms) {
            $generatorReceipt =   GeneratorReceipt::query()->where('generator_subscription_id', $receipt->generator_subscription_id)->sum('amount');
            $readingGenerator =    ReadingGenerator::query()->where('generator_subscription_id', $receipt->generator_subscription_id)->sum('consumption_value');
            $remaining_amount = $readingGenerator - $generatorReceipt;
            $message = 'تم تحصيل مبلغ ' . $request->amount . ' شيكل متبقي  ' . ($remaining_amount) . ' شيكل.';
            $this->smsService->sendSMS($mobile, $message);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function getReading(Request $request)
    {
        $reading = ReadingGenerator::query()
            ->where('id', $request->reading_id)
            ->first();

        if ($reading) {


            return response()->json([
                'success' => true,
                'data' => [
                    'current_reading' => $reading->current_reading,
                    'consumption_quantity' => $reading->consumption_quantity,
                    'consumption_value' => $reading->consumption_value,
                    'reading_generator_id' => $reading->id,
                    'generator_subscription_id' => $reading->generator_subscription_id,

                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('messages.Reading not found'),
        ]);
    }


    public function restore(Request $request)
    {
        $generator = GeneratorSubscription::withTrashed()->findOrFail($request->restore_id);

        $generator->restore();

        return response()->json([
            'status' => true,
            'message' => 'تم استرجاع  بنجاح.'
        ]);
    }

    public function getKwatPrice(Request $request)
    {



        $generator = GeneratorSubscription::withTrashed()->findOrFail($request->generator_subscription_id);
        return response()->json([
            'success' => true,
            'data' => [
                'killo_watt_cost' => $generator->killo_watt_cost,

            ],
        ]);
    }
}
