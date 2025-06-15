<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\ServiceInvoice;
use App\Models\SubscriptionInternet;
use App\Models\SubscriptionType;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserService;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InternetSubscriptionController extends Controller
{
    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function index(Request $request)
    {

        $data['branches'] = Branch::all();
        $data['subscriptionTypes'] = SubscriptionType::all();
        return  view('admin.internetSubscriptions.index', $data);
    }

    public function pending(Request $request)
    {

        $data['branches'] = Branch::all();
        $data['subscriptionTypes'] = SubscriptionType::all();
        return  view('admin.internetSubscriptions.pending', $data);
    }







    public function getPending(Request $request)
    {
        $admin = auth('admin')->user();
        $search=$request->search['value']??null;;

        $SubscriptionInternets = SubscriptionInternet::query()
        ->when($search, function ($q) use ($request, $search) {
            $q->where(function ($query) use ($request, $search) {
                $query->where('internet_code', 'like', '%' . $search . '%')
                  ->orWhere('internet_password', 'like', '%' . $search . '%');

            });
        })
            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->where('branch_id', $admin->branch_id);
            })
            ->when($request->subscription_type_id, function ($q) use ($request) {
                $q->where('subscription_type_id', $request->subscription_type_id);
            })
            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })
            ->when($request->work_space_id, function ($q) use ($request) {
                $q->whereHas('deskMangments', function ($q) use ($request) {
                    $q->where('work_space_id', $request->work_space_id);
                });
            })
            ->where('status', 2)
            ->orderby('id', 'desc');
        return datatables()->of($SubscriptionInternets)


            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('mobile', function ($data) {
                return $data->users?->mobile;
            })
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })

            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })

            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function getCancel(Request $request)
    {
        $search=$request->search['value']??null;;
        $admin = auth('admin')->user();
        $SubscriptionInternets = SubscriptionInternet::query()
        ->when($search, function ($q) use ($request, $search) {
            $q->where(function ($query) use ($request, $search) {
                $query->where('internet_code', 'like', '%' . $search . '%')
                  ->orWhere('internet_password', 'like', '%' . $search . '%')
                  ->orWhereHas('users', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('mobile', 'like', '%' . $search . '%');
                  });
            });
            })
            ->where('status', 0)
            ->orderby('id', 'desc');
        return datatables()->of($SubscriptionInternets)


            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('mobile', function ($data) {
                return $data->users?->mobile;
            })
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })
            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function getReady(Request $request)
    {
        $admin = auth('admin')->user();

        $search=$request->search['value']??null;;
        $admin = auth('admin')->user();
        $SubscriptionInternets = SubscriptionInternet::query()
            ->when($search, function ($q) use ($request, $search) {
            $q->where(function ($query) use ($request, $search) {
                $query->where('internet_code', 'like', '%' . $search . '%')
                  ->orWhere('internet_password', 'like', '%' . $search . '%')
                  ->orWhereHas('users', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('mobile', 'like', '%' . $search . '%');
                  });
            });
            })
            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->where('branch_id', $admin->branch_id);
            })
            ->when($request->subscription_type_id, function ($q) use ($request) {
                $q->where('subscription_type_id', $request->subscription_type_id);
            })
            // ->when($request->branch_id, function ($q) use ($request) {
            //     $q->where('branch_id', $request->branch_id);
            // })
            ->when($request->work_space_id, function ($q) use ($request) {
                $q->whereHas('deskMangments', function ($q) use ($request) {
                    $q->where('work_space_id', $request->work_space_id);
                });
            });

            if ($request->order_by && $request->order_direction) {
                $SubscriptionInternets->orderBy($request->order_by, $request->order_direction);
            } else {
                $SubscriptionInternets->orderBy('id', 'desc');
            }
        return datatables()->of($SubscriptionInternets)
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })
            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })
            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }




    public function getAvailable(Request $request)
    {
        $admin = auth('admin')->user();

        $SubscriptionInternets = SubscriptionInternet::query()
            // ->when(!$admin->branch_id, function ($q) use ($admin) {
            //     $q->where('branch_id', $admin->branch_id);
            // })
            ->when($request->subscription_type_id, function ($q) use ($request) {
                $q->where('subscription_type_id', $request->subscription_type_id);
            })
            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })
            ->when($request->work_space_id, function ($q) use ($request) {
                $q->whereHas('deskMangments', function ($q) use ($request) {
                    $q->where('work_space_id', $request->work_space_id);
                });
            })
            ->where('status',  3)->get();
            // ->orderBy('id', 'desc');


            // if ($request->order_by && $request->order_direction) {
            //     $SubscriptionInternets->orderBy($request->order_by, $request->order_direction);
            // } else {
            //     $SubscriptionInternets->orderBy('id', 'desc');
            // }

        return datatables()->of($SubscriptionInternets)
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })
            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })
            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function available(Request $request)
    {

        $data['branches'] = Branch::all();
        $data['subscriptionTypes'] = SubscriptionType::all();
        return  view('admin.internetSubscriptions.available', $data);
    }

    public function ready(Request $request)
    {

        $data['branches'] = Branch::all();
        $data['subscriptionTypes'] = SubscriptionType::all();
        return  view('admin.internetSubscriptions.ready', $data);
    }

    public function getExpired(Request $request)
    {
        $admin = auth('admin')->user();

        // $SubscriptionInternet = SubscriptionInternet::query()

        //     ->where(function ($query) {
        //         $query->whereNotIn('subscription_type_id', [7, 4])
        //             ->whereHas('users.logs', function ($q) {
        //                 $q->whereRaw('DATE(logs.created_at) >= subscription_internets.subscription_date')
        //                     ->selectRaw('users.id, SUM(duration) as total_duration')
        //                     ->groupBy('users.id')
        //                     ->havingRaw('total_duration > subscription_internets.duration');
        //             });
        //     })->update([
        //         'status' => 0
        //     ]);



        // SubscriptionInternet::query()
        //     ->where('subscription_type_id', 7)
        //     ->where('subscription_date', '<=', Carbon::now()->subMonth())
        //     ->update([
        //         'status' => 0
        //     ]);




        $search=$request->search['value']??null;
        $admin = auth('admin')->user();
        $SubscriptionInternets = SubscriptionInternet::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('internet_code', 'like', '%' . $search . '%')
                          ->orWhere('internet_password', 'like', '%' . $search . '%');
                })->orWhereHas('users', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('mobile', 'like', '%' . $search . '%');
                });
            })
            ->where(function ($query) {
                $query->where('subscription_type_id', '!=', 7)
                    ->whereHas('users.logs', function ($q) {
                        $q->whereRaw('DATE(logs.created_at) >= subscription_internets.subscription_date')
                            ->selectRaw('users.id, SUM(duration) as total_duration')
                            ->groupBy('users.id')
                            ->havingRaw('total_duration > subscription_internets.duration');
                    });
            })
            ->orWhereIn('status', [0, 4])

            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->where('branch_id', $admin->branch_id);
            })
            ->when($request->subscription_type_id, function ($q) use ($request) {
                $q->where('subscription_type_id', $request->subscription_type_id);
            })
            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })
            ->when($request->work_space_id, function ($q) use ($request) {
                $q->whereHas('deskMangments', function ($q) use ($request) {
                    $q->where('work_space_id', $request->work_space_id);
                });
            })
            ->orderBy('id', 'desc');
        return datatables()->of($SubscriptionInternets)
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })
            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('total_duration', function ($data) {
                return round(($data->users?->logs
                    ->where('created_at', '>=', $data->subscription_date)
                    ->sum('duration') / 60) ?? 0, 2);
            })


            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })

            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }





    public function getIndex(Request $request)
    {
        $admin = auth('admin')->user();

        $search=$request->search['value']??null;;
        $admin = auth('admin')->user();
        $SubscriptionInternets = SubscriptionInternet::query()
        ->when($search, function ($q) use ($request, $search) {
        $q->where(function ($query) use ($request, $search) {
            $query->where('internet_code', 'like', '%' . $search . '%')
              ->orWhere('internet_password', 'like', '%' . $search . '%')
              ->orWhereHas('users', function ($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('mobile', 'like', '%' . $search . '%');
              });
        });
        })
            ->when($admin->branch_id, function ($q) use ($admin) {
                $q->where('branch_id', $admin->branch_id);
            })
            ->when($request->subscription_type_id, function ($q) use ($request) {
                $q->where('subscription_type_id', $request->subscription_type_id);
            })
            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })

            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->work_space_id, function ($q) use ($request) {
                $q->whereHas('deskMangments', function ($q) use ($request) {
                    $q->where('work_space_id', $request->work_space_id);
                });
            })->get();
        return datatables()->of($SubscriptionInternets)


            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('mobile', function ($data) {
                return $data->users?->mobile;
            })
            ->addColumn('subscription_type', function ($data) {
                return $data->subscriptionType?->name;
            })

            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })

            ->addColumn('action', function ($data) {
                return view('admin.internetSubscriptions.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $data = SubscriptionInternet::find($request->internet_subscription_id);
        $data->status = $request->status;

        if ($request->status != 1) {
            $data->user_id = null;
        }
        $data->save();
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }


    public function expired(Request $request)
    {

        $data['branches'] = Branch::all();
        $data['subscriptionTypes'] = SubscriptionType::all();
        return  view('admin.internetSubscriptions.expired', $data);
    }
    public function store(Request $request)
    {
        // تحقق من وجود ملف Excel
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');

            // تحويل الملف إلى مصفوفة بيانات
            $data = Excel::toArray([], $file);
            // تحقق من أن الملف يحتوي على بيانات
            if (empty($data[0]) || count($data[0]) <= 1) {
                return response()->json([
                    'success' => false,
                    'message' => __('label.no_data_in_excel_file'),
                ]);
            }

            // استخراج رؤوس الأعمدة
            $headers = array_shift($data[0]);

            foreach ($data[0] as $row) {
                // تحويل الصف إلى مصفوفة باستخدام الرؤوس كمفاتيح
                $row = array_combine($headers, $row);

                // تحقق من الأعمدة المطلوبة في كل صف
                if (!isset($row['internet_code']) || !isset($row['internet_password'])) {
                    continue; // تجاهل الصف إذا كانت هناك بيانات مفقودة
                }

                // إضافة البيانات إلى قاعدة البيانات
                SubscriptionInternet::create([
                    'subscription_type_id' => $request->subscription_type_id,
                    'branch_id' => $request->branch_id,
                    'internet_code' => $row['internet_code'],
                    'internet_password' => $row['internet_password'],
                    'status' => 3,
                    'duration' => $request->duration,
                    'price' => $request->price,
                ]);
            }
        } else {
            // إنشاء الاشتراكات يدويًا إذا لم يكن هناك ملف Excel
            for ($i = 1; $i <= $request->quantity; $i++) {
                SubscriptionInternet::create([
                    'subscription_type_id' => $request->subscription_type_id,
                    'branch_id' => $request->branch_id,
                    'internet_code' => rand(100000, 999999),
                    'internet_password' => rand(100000, 999999),
                    'status' => 2,
                    'duration' => $request->duration,
                    'price' => $request->price,
                ]);
            }
        }

        // dd('تمت إضافة الاشتراكات بنجاح');
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function checkUsers(Request $request)
    {
        $mobile = $request->mobile;
        $users = User::where('mobile', $mobile)->get();

        if ($users->count() > 0) {
            return response()->json([
                'exists' => true,
                'users' => $users
            ]);
        } else {
            return response()->json([
                'exists' => false
            ]);
        }
    }

    public function assignSubscription(Request $request)
    {
        $SubscriptionInternets = SubscriptionInternet::where('id', $request->internet_subscription_id)->first();



        if ($request->user_id) {
            // تعيين الاشتراك للمستخدم الموجود
            $user = User::find($request->user_id);
        } else {
            // إنشاء مستخدم جديد
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,

            ]);
        }
        $SubscriptionInternets->update([

            'user_id' => $user->id,
            'status' => 1,
        ]);
        $user->update([
            'code_internet' => $SubscriptionInternets->internet_code,
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

        // dd($request->create_invoice);

        if ($request->create_invoice) {

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'amount_type' => $request->amount_type,
                'status' => $request->status ? 1 : 0,
                'due_date' => $request->end_date,
                'expiration_date' => $request->start_date,
                'subscription_internet_id' => $SubscriptionInternets->id,
                'status' => $request->status,
                'payment_type_id' => $request->payment_method,
            ]);
            $account = Account::query()->where('code', 41000)->first();

            Transaction::query()->create([
                'date' => today(),
                'amount' =>  $request->amount,
                'form_account_id' =>  $account->id,
                'to_account_id' => $user->account_id,
                'balance_type_id' => 6,
                'invoice_id' => $invoice->id,

            ]);




            if ($user && $user->mobile) {
                $amountType = $invoice->amount_type == 1 ? 'دولار' : 'شيكل';
                $skekel_amount = Invoice::query()->where('user_id',$user->id)->where('amount_type', 2)->where('status', 0)->sum('amount');
                $dollar_amount = Invoice::query()->where('user_id',$user->id)->where('amount_type', 1)->where('status', 0)->sum('amount');
                $message = "تم إصدار فاتورة مستحقة بقيمة {$invoice->amount} {$amountType}.\n";

                if ($dollar_amount > 0 && $skekel_amount > 0) {
                    $message .= "إجمالي المستحقات: {$dollar_amount} $ و {$skekel_amount}  ₪.";
                    } elseif ($dollar_amount > 0) {
                    $message .= "إجمالي المستحقات: {$dollar_amount} $.";
                    } elseif ($skekel_amount > 0) {
                    $message .= "إجمالي المستحقات: {$skekel_amount}  ₪.";
                    }

                $this->smsService->sendSMS($user->mobile, $message);
            }

        }



        if ($request->send_internet) {
            if ($user && $user->mobile) {
                $message = "رقم الحساب الخاص بك هو: {$SubscriptionInternets->internet_code}\nكلمة المرور: {$SubscriptionInternets->internet_password}";
                $this->smsService->sendSMS($user->mobile, $message);
            }
        }





        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
}
