<?php

namespace App\Http\Controllers\Admin\GeneratorSubscritions;

use App\Http\Controllers\Controller;
use App\Models\Generator;
use App\Models\GeneratorSubscription;
use App\Models\ReadingGenerator;
use App\Services\SMSService;
use Illuminate\Http\Request;

class ReadingGeneratorController extends Controller
{
    protected SMSService $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index(Request $request)
    {
        $data['generator_subsriptions'] = GeneratorSubscription::query()->get();
        $data['status'] = $request->status;

        $data['generators'] = Generator::query()->get();
        return view('admin.readingGenerators.index', $data);
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? '';
        $generator_id = $request->generator_id;
        $generator_subscription_id = $request->generator_subscription_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $readingGenerators = ReadingGenerator::query()
            ->with('generatorSubscriptions')
            ->when($request->status, function ($q) {
                $q->onlyTrashed();
            })
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
            })
            ->orderBy('id', 'desc');

        return datatables()->of($readingGenerators)
            ->addColumn('action', function ($data) {
                return view('admin.readingGenerators.partials.actions', compact('data'));
            })
            ->addColumn('actions', function ($data) {
                return view('admin.generatorSubscriptions.partials.readerActions', compact('data'));
            })
            ->addColumn('name', function ($data) {
                return $data->generatorSubscriptions?->name ?? '';
            })
            ->addColumn('mobile', function ($data) {
                return $data->generatorSubscriptions?->mobile ?? '';
            })
            ->addColumn('generator_name', function ($data) {
                return $data->generatorSubscriptions?->generator?->name ?? '';
            })
            ->rawColumns(['action', 'actions'])
            ->make(true);
    }



    public function store(Request $request)
    {

        $request->validate([
            'generator_subscription_id' => 'required|exists:generator_subscriptions,id',
            'previous_reading' => 'nullable|numeric',
            'current_reading' => 'required|numeric',
            'consumption_quantity' => 'required|numeric',
        ]);

        $lastReading = ReadingGenerator::query()
            ->where('generator_subscription_id', $request->generator_subscription_id)
            ->orderBy('id', 'desc')
            ->first();
        $generatorSubscriptions = GeneratorSubscription::query()->find($request->generator_subscription_id);

        $previousReading = $lastReading
            ? $lastReading->current_reading
            : ($generatorSubscriptions->initial_reading ?? 0);

        ReadingGenerator::create([
            'generator_subscription_id' => $request->generator_subscription_id,
            'previous_reading' => $previousReading,
            'current_reading' => $request->current_reading,
            'consumption_value' => $request->consumption_value,
            'consumption_quantity' => $request->consumption_quantity,
        ]);



        $mobile = $generatorSubscriptions->mobile;
        if ($mobile && $request->send_sms) {
            $message = 'القراءة السابقة: ' . $previousReading . ', القراءة الحالية: ' . $request->current_reading . ', المبلغ المستحقة: ' . $request->consumption_value . ' شيكل';
            $this->smsService->sendSMS($mobile, $message);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {




        $readingGenerator = ReadingGenerator::findOrFail($request->reading_generator_id);

        $lastReading = ReadingGenerator::query()
            ->where('generator_subscription_id', $readingGenerator->generator_subscription_id)
            ->where('id', '=', $readingGenerator->id)
            ->orderBy('id', 'desc')
            ->first();

            if ($lastReading && $lastReading->id == $request->reading_generator_id) {
                $lastReading = ReadingGenerator::query()
                    ->where('generator_subscription_id', $request->generator_subscription_id)
                    ->where('id', '<', $request->reading_generator_id) // التأكد من أن القراءة السابقة لها id أصغر
                    ->orderBy('id', 'desc') // ترتيب النتائج من الأحدث إلى الأقدم
                    ->first();
            }


            $previousReading = $lastReading
                ? $lastReading->current_reading
                : ($generatorSubscriptions->initial_reading ?? 0);
        $readingGenerator->update([
            'previous_reading' => $previousReading,
            'current_reading' => $request->current_reading,
            'consumption_value' => $request->consumption_quantity,
        ]);


        if ($readingGenerator->generatorSubscriptions->mobile && $request->send_sms) {
            $message = 'القراءة السابقة: ' . $previousReading . ', القراءة الحالية: ' . $request->current_reading . ', المبلغ المستحقة: ' . $request->consumption_value . ' شيكل';
            $this->smsService->sendSMS($readingGenerator->generatorSubscriptions->mobile, $message);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        ReadingGenerator::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function search(Request $request)
    {
        $generatorId = $request->generator_id;
        $subscriptionId = $request->generator_subscription_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = ReadingGenerator::query();

        if ($generatorId) {
            $query->whereHas('generatorSubscriptions', function ($q) use ($generatorId) {
                $q->where('generator_id', $generatorId);
            });
        }
        if ($subscriptionId) {
            $query->where('generator_subscription_id', $subscriptionId);
        }

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $consumption_quantity = $query->sum('consumption_quantity');
        $consumption_value = $query->sum('consumption_value');
        $totalSubscribers = $query->distinct('generator_subscription_id')->count('generator_subscription_id');

        return response()->json([
            'total_subscribers' => $totalSubscribers,
            'consumption_quantity' => $consumption_quantity,
            'consumption_value' => $consumption_value,
        ]);
    }

    public function restore(Request $request)
    {
        $generator = ReadingGenerator::withTrashed()->findOrFail($request->restore_id);

        $generator->restore();

        return response()->json([
            'status' => true,
            'message' => 'تم استرجاع  بنجاح.'
        ]);
    }
}
