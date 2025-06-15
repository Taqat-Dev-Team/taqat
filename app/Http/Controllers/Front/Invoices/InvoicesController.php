<?php

namespace App\Http\Controllers\Front\Invoices;

use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\SubscriptionInternet;
use App\Models\User;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class InvoicesController extends Controller
{
    //

    protected SMSService $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index()
    {
        return view('front.invoices.index');
    }

    public function getIndex(Request $request)
    {

        $search = $request->search['value'] ?? false;
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;

        // Start building the query
        $userQuery = Invoice::query()
            ->where('user_id', auth()->id())->get();

        // Apply search filters

        $userQuery->when($search, function ($q) use ($search) {
            $q->wherehas('users', function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')->orwhere('mobile', 'like', '%' . $search . '%')->orwherehas('branch', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
                });
            });
        });


        $userQuery->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });


        // Prepare DataTable
        return DataTables::of($userQuery)
            ->addColumn('photo', function ($data) {
                if ($data->photo) {
                    return '<a href="' . $data->photo . '" target="_blank">
                    <img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius:50%;">
                </a>';
                } else {
                    return '<img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius:50%;">';
                }
            })
            ->addColumn('user_name', fn($data) => $data->users->name ?? '-')
            ->addColumn('amount', function ($data) {
                if ($data->amount) {
                    $amountType = $data->amount_type == 1 ? 'دولار' : ($data->amount_type == 2 ? 'شيكل' : '-');
                    return $data->amount . ' ' . $amountType;
                }
                return '-';
            })
            ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d') ?? '-')
            ->addColumn('status', fn($data) => $data->getStatus() ?? '-')

            ->addColumn('action', function ($data) {


                $button = '<a title="رفع مرفق"  class="invoice" data-amount="' . $data->amount . '" data-invoce_id="' . $data->id . '">
                    <span><i class="fas fa-upload"></i></span>
                </a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;'; // Add spacing

                // if (auth()->user()->exemption != 2 && !$data->exemption) {
                //     $button .= '<a  title="طلب اعفاء من الرسوم" href="#" class="exemption-icon" data-invoice-id="' . $data->id . '">
                //     <i class="fas fa-percent"></i>
                // </a>';
                // }
                return $button;
            })
            ->rawColumns(['status', 'photo', 'action'])
            ->make(true);
    }

    public function getInvoicesData(Request $request)
    {

        // Set start and end date
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;

        $branch_id = $request->branch_id ?? false;


        $invoices = Invoice::query()->where('user_id', auth()->id())
            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [$start_date, $end_date]);
            });
        $total_invoices = number_format($invoices->sum('amount'), 2);

        $total_payment = number_format($invoices
            ->where('status', 1)->sum('amount'), 2);
        // Total user count

        $response['data'] = [
            'total_invoice' => $total_invoices,
            'total_payment' => $total_payment,
        ];

        return response()->json($response);
    }

    public function update(Request $request)
    {

        $invoice = Invoice::query()->where('user_id', auth()->id())->where('id', $request->invoce_id)->first();

        $invoice->update([
            'status' => 2,
        ]);

        $user=$invoice->users;

        if ($request->photo) {
            $photo = upload($request->photo);

            Invoice::query()->where('user_id', auth()->id())->where('id', $request->invoce_id)->update(
                ['photo' => url('/') . '/public/files/' . $photo]
            );
        }

        // $SubscriptionInternets = SubscriptionInternet::query()
        // ->where('branch_id', $user->branch_id)
        //     ->where('status', 3)
        //     ->first();

        // $user = User::query()->where('id', $invoice->user_id)->first();
        // if ($user && $user->mobile) {
        //     $message = "رقم الحساب الخاص بك هو: {$SubscriptionInternets->internet_code}\nكلمة المرور: {$SubscriptionInternets->internet_password}";
        //     $this->smsService->sendSMS($user->mobile, $message);
        // }
        return response_web(true, 'نجاح العملية', [], 201);
    }

    public function exemption(Request $request)
    {



        Invoice::query()->where('user_id', auth()->id())->where('id', $request->invoice_id)->update([
            'exemption' => 1
        ]);


        auth()->user()->update([
            'exemption' => +1
        ]);
        return response_web(true, 'نجاح العملية', [], 201);
    }
}
