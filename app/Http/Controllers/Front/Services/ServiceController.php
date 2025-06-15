<?php

namespace App\Http\Controllers\Front\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Services\ServiceRequest;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\ServiceInvoice;
use App\Models\UserService;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index()
    {

        $data['services'] = Service::query()
        ->where('id','<>',1)
        ->get();
        return view('front.services.index', $data);
    }
    public function getIndex(Request $request)
    {

        $services = UserService::query()
            ->whereHas('services')
            ->where('status', '<>', 0)

            ->where('service_id', '<>', 1)
            ->orderby('id', 'desc')->get();
        return datatables()->of($services)
            ->addColumn('name', function ($data) {

                return $data->services?->name;
            })
            ->addColumn('action', function ($data) {
                return view('front.services.partials.actions', compact('data'));
            })
            ->addColumn('amount', function ($data) {
                return $data->amount . ' ' . ($data->services?->amount_type == 1 ? 'دولار' : 'شيكل');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(ServiceRequest $request)
    {


        $service = Service::query()->find($request->service_id);

        $service = Service::query()->findOrFail($request->service_id);
        $serviceAmount = $service->amount;
        $daysInMonth = Carbon::now()->daysInMonth;
        $currentDay = Carbon::now()->day;
        $remainingDays = $daysInMonth - $currentDay;

        $calculatedAmount = ($serviceAmount / $daysInMonth) * $remainingDays * $request->quantity;

   $userService=     UserService::query()->create([
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
            'service_id' => $service->id,
            'amount' => $calculatedAmount,
            'start_date'=>today(),
        ]);

        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'amount' => abs(round($calculatedAmount, 2)),
            'amount_type' => $service->amount_type,
            'status' => 0,
            'due_date' => today(),
            'expiration_date' => now()->endOfMonth()->format('Y-m-d'),
        ]);

            ServiceInvoice::query()->create([
                'invocie_id' => $invoice->id,
                'user_service_id' => $userService->id,
                'amount' => abs(round($calculatedAmount, 2)),
            ]);


            $amountType = $request->amout_type == 1 ? 'دولار' : 'شيكل';
            $message = "تم إصدار فاتورة مستحقة بقيمة {$calculatedAmount} {$amountType}.";
            $this->smsService->sendSMS(auth()->user()->mobile, $message);


        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }


    public function delete(Request $request)
    {
        $service = UserService::query()->find($request->id)->update([
         'status' => 0,
        'end_date' => now()->endOfMonth()->format('Y-m-d'),
    ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function getAmount(Request $request)
    {
        $totalAmount = 0;
        $calculatedAmounts = [];
        $daysInMonth = Carbon::now()->daysInMonth;
        $currentDay = Carbon::now()->day;
        $remainingDays = $daysInMonth - $currentDay;

            $service = Service::query()->find($request->service_id);
            if (!$service) {
                return response()->json(['status' => 404, 'message' => 'Service not found']);
            }
            $serviceAmount = $service->amount;
            $service_type = $service->amount_type==1?   'دولار':'شيكل';
            $calculatedAmount = ($serviceAmount / $daysInMonth) * $remainingDays * $request->quantity;

        return response()->json([
            'status' => 200,
            'calculated_amount' => round($calculatedAmount, 2) .$service_type,
        ]);
    }
}
