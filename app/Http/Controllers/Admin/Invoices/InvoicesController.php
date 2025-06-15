<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Exports\CompletionReportExport;
use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\SubscriptionInternet;
use App\Models\Transaction;
use App\Models\User;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Tag\Sub;
use NumberToWords\NumberToWords;
use Yajra\DataTables\DataTables;

class InvoicesController extends Controller
{


    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public  function  index()
    {

        $data['users'] = User::query()
            ->when(auth('admin')->user()->bracnh_id, function ($q) {
                // $q->wherehas('users', function ($q) {
                $q->where('branch_id', auth('admin')->user()->branch_id);
                // });
            })
            ->get();


        $data['paymentTypes'] = Account::query()->where('parent_id', 7)->get();

        $data['branches'] = Branch::query()->get();
        return view('admin.invoices.index', $data);
    }


    public function getIndex(Request $request)
    {
        $expiration_date = $request->expiration_date ?? false;
        $invoiceQuery = Invoice::query();

        $admin = auth('admin')->user();

        $invoiceQuery->whereHas('users', function ($q) use ($admin) {
            $q->when($admin->branch_id, function ($q) {
                $q->whereHas('branch', function ($q) {
                    $q->where('id', auth('admin')->user()->branch_id);
                });
            });
        });

        // Additional filters
        $invoiceQuery->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id));
        $invoiceQuery->when(
            $request->status_id,
            fn($q) => $q->where('status', $request->status_id == 4 ? 0 : $request->status_id)
        );
        $invoiceQuery->when(
            $request->branch_id,
            fn($q) =>
            $q->whereHas('users', fn($q) => $q->where('branch_id', $request->branch_id))
        );




        $invoiceQuery->when(
            $request->start_date && $request->end_date,
            fn($q) =>
            $q->whereBetween('created_at', [$request->start_date, $request->end_date])
        );

        if ($request->has('order')) {
            $orderColumn = $request->input('columns')[$request->input('order.0.column')]['data'];
            $orderDirection = $request->input('order.0.dir');
            if ($orderColumn === 'created_at') {
                $invoiceQuery->orderBy('created_at', $orderDirection);
            } else {
                $invoiceQuery->orderBy('created_at', 'desc');
            }
        } else {
            $invoiceQuery->orderBy('created_at', 'desc');
        }

        // If export is requested
        if ($request->has('export')) {
            return Excel::download(new InvoiceExport($invoiceQuery), 'invoices.xlsx');
        }

        // DataTables response
        return DataTables::of($invoiceQuery)
            ->addColumn(
                'photo',
                fn($data) =>
                '<a href="javascript:void(0);" class="show-photo-modal" data-photo="' . $data->getPhoto() . '">
                    <img src="' . $data->getPhoto() . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">
                </a>'
            )
            ->addColumn('mobile', fn($data) => $data->users->mobile ?? '-')
            ->addColumn('user_name', fn($data) => $data->users ? '<a target="_blank" href="' . route('admin.users.views', $data->user_id) . '">' . $data->users->name . '</a>' : '-')

            ->addColumn('amount', function ($data) {
                $amountType = $data->currencies?->value ?? '-';
                return $data->amount . ' ' . $amountType;
            })
            ->addColumn('branch', fn($data) => $data->users->branch?->name ?? '-')
            ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d') ?? '-')
            ->addColumn('status', fn($data) => $data->getStatus() ?? '-')
            ->addColumn('action', function ($data) {

                return view('admin.invoices.partials.actions', compact('data'));
            })


            ->rawColumns(['status', 'photo', 'action', 'user_name'])
            ->make(true);
    }


    // Helper function for generating action buttons
    private function generateActionButtons($data)
    {
        $smsButton = '<a class="sendSms" data-user_id="' . $data->user_id . '">
                        <span><i class="fas fa-sms" style="color:black"></i></span>
                      </a>';

        $editButton = '<a class="invoice" data-invoice_id="' . $data->id . '" data-amount="' . $data->amount . '" data-status="' . $data->status . '">
                        <span><i class="fas fa-edit" style="color:blue"></i></span>
                      </a>';

        $deleteButton = !$data->photo ?
            '<a id="' . $data->id . '" name_delete="' . $data->users?->name . '" class="delete">
                <span><i style="color:red" class="fa fa-trash"></i></span>
             </a>' : null;

        $generateReceiptButton = '<a href="' . route('generate.receipt', ['id' => $data->id]) . '" target="_blank">
                                    <span><i class="fas fa-file-pdf" style="color:green"></i></span>
                                  </a>';

        return $smsButton . '&nbsp;&nbsp;&nbsp;&nbsp;'
            . $editButton . '&nbsp;&nbsp;&nbsp;&nbsp;'
            . $generateReceiptButton . '&nbsp;&nbsp;&nbsp;&nbsp;'
            . $deleteButton;
    }




    public function generateReceipt(Request $request)
    {
        $invoice = Invoice::query()->findOrFail($request->invoice_id);
        $year = date('Y');

        $serviceName = optional(optional(optional($invoice->invoiceService)->userService)->Services)->name;

        // تنسيق رقم السند (تاريخ + رقم الفاتورة مع أصفار)
        $sanedNumber = sprintf('%s-%06d', date('Y'), $invoice->id);
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('ar');

        // المبلغ بالأرقام
        $amount = $invoice->amount;

        // تحويل المبلغ إلى حروف
        $amountInWords = $numberTransformer->toWords($amount);
        $data = [
            'sanedNumber' => $sanedNumber,
            'name' => $invoice->users?->name,
            'recipientName' => auth('admin')->user()->name,
            'purpose' =>  'تسديد مستحقات خدمة ' . $serviceName,
            'amount_letter' => $amountInWords .  ' ' . $invoice->currencies?->value . ' ' . 'فقط لا غير',

            'amount' => $amount .  ' ' . $invoice->currencies?->value,
        ];

        $html = view('admin.invoices.pdf.receipt', $data)->render();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A5', // تحديد حجم الورقة A5
            'orientation' => 'L' // الاتجاه رأسي (P) أو أفقي (L)

        ]);


        $mpdf->WriteHTML($html);
        $mpdf->Output('receipt.pdf', 'I');
    }


    public function getInvoicesData(Request $request)
    {
        $admin = auth('admin')->user();
        $user_id = $request->user_id;
        $status_id = $request->status_id;
        $branch_id = $request->branch_id;
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d') : null;
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null;

        $query = User::query()
            ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id))
            ->when($branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $branch_id)))
            ->where('status', 1)
            ->when($user_id, fn($q) => $q->whereIn('id', (array) $user_id));

        $total_invoices = Invoice::query()
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->when($status_id, fn($q) => $q->where('status', $request->status_id == 4 ? 0 : $request->status_id))

            ->when($start_date && $end_date, fn($q) => $q->whereBetween('created_at', [$start_date, $end_date]))
            ->whereHas('users', function ($q) use ($branch_id, $admin) {
                $q->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
                    ->when($branch_id, fn($q) => $q->where('branch_id', $branch_id));
            })

            ->sum('amount');
        $total_payment = Invoice::query()
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->where('status', 1)
            ->whereHas('users', function ($q) use ($branch_id, $admin) {
                $q->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
                    ->when($branch_id, fn($q) => $q->where('branch_id', $branch_id));
            })

            ->when($start_date && $end_date, fn($q) => $q->whereBetween('created_at', [$start_date, $end_date]))
            ->sum('amount');

        $response = [
            'data' => [
                'user_count' => $query->count(),
                'total_invoice' => number_format($total_invoices, 2),
                'total_payment' => number_format($total_payment, 2),
            ],
        ];

        return response()->json($response);
    }

    public  function  update(Request $request)
    {

        $invoice = Invoice::query()->where('id', $request->invoce_id)->first();
        $user = User::find($invoice->user_id); // تأكد من توفير معرف المستخدم في الطلب

        if ($invoice->amount != $request->amount) {
            $amountType = $request->amout_type == 1 ? 'دولار'  : 'شيكل';

            $message = "نعلمكم أنه تم تعديل المبلغ الفاتورة  إلى " . $request->amount . $amountType;

            if ($user && $user->mobile) {
                // $this->smsService->sendSMS($user->mobile, $message);
            }
        }




        if ($request->photo) {
            $photo = upload($request->photo);

            Invoice::query()->where('id', $request->invoce_id)->update(
                ['photo' => url('/') . '/public/files/' . $photo]
            );
        }

        $invoice->update([
            'status' => $request->status,
            'amount' => $request->amount,
            'amount_type' => $request->amout_type,
            'due_date' => Carbon::parse($request->due_date)->format('Y-m-d'),
            'expiration_date' => Carbon::parse($request->expiration_date)->format('Y-m-d'),

        ]);

        if (!$user->account_id) {

            $parent = Account::query()->where('code', 41000)->first();

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

            $account =  Account::create([
                'name' => $user->name,
                'code' => $newCode,
                'parent_id' => $parent->id,
                'type_id' => $parent->type_id,
                'balance_type_id' => $parent->balance_type_id,
                'user_id' => $user->id,
            ]);

            $user->update([
                'account_id' => $account->id,
            ]);
        }
        if ($request->status == 1) {




            $user = User::find($invoice->user_id); // تأكد من توفير معرف المستخدم في الطلب
            $code = '';
            // if ($request->payment_type_id == 1) {

            //     $code = 10021;
            // } else {
            //     $code = 10022;
            // }

            $account = Account::query()->where('id', $request->payment_type_id)->first();
        //    dd($account);
            if ($account) {
                Transaction::query()->create([
                    'date' => today(),
                    'amount' => $invoice->amount,
                    'form_account_id' => $user->account_id,
                    'to_account_id' => $account->id,
                    'balance_type_id' => 7,
                    'invoice_id' => $invoice->id,
                ]);
            }

            $invoice->update([
                'payment_type_id' => $account->id,
            ]);

            //     if ($user && $user->mobile) {
            //         $message = "رقم الحساب الخاص بك هو: {$SubscriptionInternets->internet_code}\nكلمة المرور: {$SubscriptionInternets->internet_password}";
            //         $this->smsService->sendSMS($user->mobile, $message);
            //     }

            // if ($invoice->subscription_internet_id) {
            //     $SubscriptionInternets = SubscriptionInternet::query()
            //         ->where('id', $invoice->subscription_internet_id)
            //         // ->where('status', 3)
            //         ->first();

            //     if ($user && $user->mobile) {
            //         $message = "رقم الحساب الخاص بك هو: {$SubscriptionInternets->internet_code}\nكلمة المرور: {$SubscriptionInternets->internet_password}";
            //         $this->smsService->sendSMS($user->mobile, $message);
            //     }
            // }else{
            // $SubscriptionInternets = SubscriptionInternet::query()
            //     ->where('branch_id', $user->branch_id)
            //     ->where('status', 3)
            //     ->first();

            // if ($SubscriptionInternets) {
            //     $user->update([
            //         'code_internet' => $SubscriptionInternets->internet_code,
            //     ]);


            //     $SubscriptionInternets->update([
            //         'status' => 1,
            //         'user_id' => $user->id,
            //     ]);


            // }
            // }
        }
        return response_web(true, 'نجاح العملية', [], 201);
    }


    public function sendInvoiceSms(Request $request)
    {
        $message = $request->message;


        Invoice::query()
            ->get()
            ->where('status', 0)
            ->unique('user_id')

            ->each(function ($invoice) use ($message) {
                $user = $invoice->users;
                if ($user) {
                    // dd($user);
                    $this->smsService->sendSMS($user->mobile, $message);
                }
            });

        return response_web(true, 'نجاح العملية', [], 201);
    }


    public function delete(Request $request)
    {

        Invoice::query()->where('id', $request->id)->delete();
        return response_web(true, 'نجاح العملية', [], 201);
    }

    public function sendSms(Request $request)
    {

        $user = User::find($request->user_id);
        $message = $request->message;
        // $this->smsService->sendSMS($user->mobile, $message);

        return response_web(true, 'نجاح العملية', [], 201);
    }
}
