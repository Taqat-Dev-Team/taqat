<?php

namespace App\Http\Controllers\Admin\GeneratorSubscritions;

use App\Http\Controllers\Controller;
use App\Models\Generator;
use App\Models\GeneratorReceipt;
use App\Models\GeneratorSubscription;
use App\Models\ReadingGenerator;
use App\Services\SMSService;
use Illuminate\Http\Request;

class GeneratorReceiptController extends Controller
{

    protected SMSService $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index(Request $request)
    {


        $data['generator_subsriptions'] = GeneratorSubscription::query()->get();
        $data['generators'] = Generator::query()->get();

        $data['status'] = $request->status;

        return view('admin.generatorReceipts.index', $data);
    }






    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? '';

        $search = $request->search['value'] ?? '';
        $generator_id = $request->generator_id;
        $generator_subscription_id = $request->generator_subscription_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $generatorReceipts = GeneratorReceipt::query()
            ->wherehas('generatorSubscriptions')
            ->with('generatorSubscriptions')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('generatorSubscriptions', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('mobile', 'like', '%' . $search . '%');
                });
            })
            ->when($request->status, function ($q) {
                $q->onlyTrashed();
            })
            ->when($generator_id, function ($query) use ($generator_id) {
                $query->whereHas('generatorSubscriptions', function ($q) use ($generator_id) {
                    $q->where('generator_id', $generator_id);
                });
            })
            ->when($generator_subscription_id, function ($query) use ($generator_subscription_id) {
                $query->where('generator_subscription_id', $generator_subscription_id);
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            })
            ->orderBy('id', 'desc');

        return datatables()->of($generatorReceipts)
            ->addColumn('action', function ($data) {
                return view('admin.generatorReceipts.partials.actions', compact('data'));
            })

            ->addColumn('name', function ($data) {
                return $data->generatorSubscriptions?->name ?? '';
            })
            ->addColumn('generator_name', function ($data) {
                return $data->generatorSubscriptions?->generator?->name ?? '';
            })
            ->addColumn('mobile', function ($data) {
                return $data->generatorSubscriptions?->mobile ?? '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }













    public function store(Request $request)
    {

        GeneratorReceipt::create([
            'amount' => $request->amount,
            'date' => $request->date,

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }



    public function delete(Request $request)
    {
        GeneratorReceipt::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }











    public function update(Request $request)
    {
        $receipt = GeneratorReceipt::query()->where('id', $request->receipt_id)->first();
        if ($receipt) {
            $receipt->update([
                'amount' => $request->amount,
                'date' => $request->date,
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

    public function search(Request $request)
    {
        $search = $request->search['value'] ?? '';

        $search = $request->search['value'] ?? '';
        $generator_id = $request->generator_id;
        $generator_subscription_id = $request->generator_subscription_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;


        // الحصول على معرفات الاشتراكات الخاصة بالمولد (إن وُجد)
        $subscriptionIds = GeneratorSubscription::when($generator_id, function ($query) use ($generator_id) {
            $query->where('generator_id', $generator_id);
        })
        ->when($generator_subscription_id, function ($query) use ($generator_subscription_id) {
            $query->where('id', $generator_subscription_id);
        })
        ->pluck('id');

        // الإحصائيات
        $totalSubscribers = $subscriptionIds->count();



        $totalCollections =     $generatorReceipts = GeneratorReceipt::query()
            ->wherehas('generatorSubscriptions')
            ->with('generatorSubscriptions')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('generatorSubscriptions', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('mobile', 'like', '%' . $search . '%');
                });
            })
            ->when($generator_id, function ($query) use ($generator_id) {
                $query->whereHas('generatorSubscriptions', function ($q) use ($generator_id) {
                    $q->where('generator_id', $generator_id);
                });
            })
            ->when($generator_subscription_id, function ($query) use ($generator_subscription_id) {
                $query->where('generator_subscription_id', $generator_subscription_id);
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            })->sum('amount');


        return response()->json([
            'total_subscribers'       => $totalSubscribers,
            'total_collections'       => $totalCollections,
        ]);
    }

    public function restore(Request $request)
    {
        $generator = GeneratorReceipt::withTrashed()->findOrFail($request->restore_id);

        $generator->restore();

        return response()->json([
            'status' => true,
            'message' => 'تم استرجاع  بنجاح.'
        ]);
    }
}
