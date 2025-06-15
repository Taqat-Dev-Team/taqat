<?php

namespace App\Http\Controllers\Admin\Users;

use App\Exports\{LogUserExport, UsersExport};
use App\Http\Controllers\Admin\InternetSubscriptionController;
use App\Http\Controllers\Admin\Subscriptions\SubScriptionController;
use App\Http\Controllers\Controller;
use App\Http\Requests\{Admin\Users\AddUserRequest, Front\Services\ServiceRequest};
use App\Http\Requests\Admin\Users\addSubscriptionRequest;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Models\{
    Account,
    Attachment,
    Attendance,
    Branch,
    Company,
    Constant,
    DeskMangment,
    DeskMangmentHistory,
    Expense,
    IncomeMovement,
    Invoice,
    jobContract,
    JoinRequest,
    Log,
    Room,
    Service,
    ServiceInvoice,
    Specialization,
    SubscriptionInternet,
    SubscriptionType,
    Transaction,
    User,
    UserService,
    wallet,
    walletRecipt,
    WorkSpace
};
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{DB, Hash};
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    protected SMSService $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function getChildExpenses(Request $request)
    {
        $account = Account::where('parent_id', $request->expense_id)->get();
        return response()->json([
            'success' => true,
            'child_expenses' => $account
        ]);
    }
    public function getUserExpenses(Request $request)
    {
        $user_id = $request->user_id;

        // Fetch total amounts
        $total_expense = Expense::where('user_id', $user_id)->sum('amount');
        $total_payment = Expense::where('user_id', $user_id)->where('status', 'paid')->sum('amount');

        // Fetch expense list for the user
        $expenses = Expense::where('user_id', $user_id)->get();

        return DataTables::of($expenses)
            ->editColumn('status', function ($expense) {
                return $expense->status == 1 ? __('label.paid') : __('label.unpaid');
            })
            ->with([
                'total_expense' => number_format($total_expense, 2),
                'total_payment' => number_format($total_payment, 2)
            ])
            ->make(true);
    }


    /**
     * Display users index page
     */
    public function index(Request $request)
    {

        $admin = auth('admin')->user();
        $userQuery = $this->buildUserQuery($request, $admin);
        $userIds = $userQuery->pluck('id')->toArray();

        return view('admin.users.index', [
            'companies' => Company::all(),
            'services' => Service::all(),
            'branches' => Branch::all(),

            'currencies' => Constant::query()->where('key', 'currency')->whereNotNull('parent_id')->get(),
            'status' => $request->status ?? false,
            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'user_count' => $userQuery->count(),
            'subscriptionTypes' => SubscriptionType::all(),
            'total_contracts' => $this->getTotalContracts($admin, $request->branch_id, $userIds),
            'total_movements' => $this->getTotalMovements($admin, $request->branch_id, $userIds),
            'expenses' => Account::query()->where('type_id', 2)->get(),
            'userTypes' => Constant::query()->whereNotNull('parent_id')->where('key', 'user_types')->get(),

            'paymentTypes' => Account::query()->where('parent_id', 7)->get(),
        ]);
    }

    public function veririfcation(Request $request)
    {


        return view('admin.users.verification');
    }

    /**
     * Get users data for DataTables
     */
    public function getIndex(Request $request): JsonResponse
    {
        $admin = auth('admin')->user();
        $userQuery = $this->buildDataTablesQuery($request, $admin);

        return DataTables::of($userQuery)
            ->addColumn('branch_name', fn($user) => $user->branch->name ?? '-')
            ->addColumn('total_work_hours', fn($user) => $user->attendanceTotalHoursCurrentMonthly())
            ->addColumn('company_name', fn($user) => $user->companies->name ?? '-')
            ->addColumn('user_name', $this->getUserNameColumn())
            ->addColumn('total_contracts', fn($user) => $user->totalContracts())
            ->addColumn('total_invoice', fn($user) => $user->totalInvoiceNotPaid())
            ->addColumn('code_internet', fn($user) => $user->code_internet)
            ->addColumn('total_movements', fn($user) => $user->totalIncome())
            ->addColumn('photo', $this->getPhotoColumn())
            ->addColumn('Whatsapp', $this->getWhatsappColumn())
            ->addColumn('call_whatsapp_count', fn($user) => $user->userLogWhatsappClicks->count())


            ->addColumn('action', fn($data) => view('admin.users.partials.actions', compact('data')))
            ->rawColumns(['photo', 'action', 'user_name', 'Whatsapp', 'total_invoice'])
            ->make(true);
    }

    public function getVerification(Request $request)
    {
        $query = User::query()
            ->where('is_verification', 3)
            ->when(isset($request->search['value']) && $request->search['value'], fn($q) => $this->applySearch($q, $request->search['value']));
        return DataTables::of($query)
            ->addColumn('photo', function ($data) {
                return '<a href="#"  class="show_id_photo" data-photo="' . $data->getIdPhoto() . '">'
                    . '<img src="' . $data->getIdPhoto() . '" class="circle" '
                    . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                    . '</a>';
            })
            ->addColumn('action', function ($data) {
                return view('admin.users.partials.verification_actions', compact('data'));
            })

            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    /**
     * Show user details
     */
    public function show($id)
    {
        $data['currencies'] = Constant::query()->where('key', 'currency')->whereNotNull('parent_id')->get();
        $data['user'] = User::findOrFail($id);
        return view('admin.users.view', $data);
    }

    /**
     * Show user creation form
     */
    public function create()
    {
        return view('admin.users.add', [
            'companies' => Company::all(),
            'branches' => Branch::all(),
            'services' => Service::all(),
            'universities' => Constant::query()->where('parent_id', 32)->get(),
            'specializations' => Specialization::all(),
            'userTypes' => Constant::query()->whereNotNull('parent_id')->where('key', 'user_types')->get()
        ]);
    }

    /**
     * Store a new user
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $user = $this->createUser($request);

            $this->createUserAccount($user);
            $this->logActivity('Created a new user', $user);

            return response()->json([
                "status" => 201,
                "message" => 'تمت عملية الاضافة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => 'لم يتم تنفيد العملية بنجاح'
            ]);
        }
    }

    /**
     * Show user edit form
     */
    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => User::findOrFail($id),
            'companies' => Company::all(),
            'branches' => Branch::all(),
            'services' => Service::all(),
            'universities' => Constant::query()->where('parent_id', 32)->get(),

            'specializations' => Specialization::all(),
            'userTypes' => Constant::query()->whereNotNull('parent_id')->where('key', 'user_types')->get()

        ]);
    }

    /**
     * Update user details
     */
    public function update(UserRequest $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $this->updateUser($user, $request);
            $this->logActivity('Updated user details', $user);

            return response()->json([
                'success' => true,
                'message' => 'تم تنفيذ العملية بنجاح',
                'data' => url()->current()
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم تنفيذ العملية بنجاح'
            ], 500);
        }
    }

    /**
     * Delete a user
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            $user = User::findOrFail($request->id);
            $user->delete();
            $this->logActivity('Delete user', $user);

            return response()->json([
                "status" => 201,
                "message" => 'تمت عملية الحذف بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => 'لم يتم تنفيد العملية بنجاح'
            ]);
        }
    }

    /**
     * Get user services list
     */
    public function serviceList(Request $request): JsonResponse
    {
        $services = UserService::with('services')
            ->where('user_id', $request->user_id)
            ->get()
            ->map(function ($userService) {
                return [
                    'id' => $userService->id,
                    'name' => $userService->services->name ?? '-',
                    'amount' => $userService->amount,
                    'quantity' => $userService->quantity,
                    'status' => $userService->getStatus(),
                    'start_date' => $userService->start_date,
                    'end_date' => $userService->end_date ?? 'حتى الان',
                ];
            });

        return response()->json(['services' => $services]);
    }

    /**
     * Add service to user
     */
    public function addService(ServiceRequest $request): JsonResponse
    {
        $user = User::findOrFail($request->user_id);
        $service = Service::findOrFail($request->service_id);

        $calculatedAmount = $service->amount * $request->quantity;

        $calculatedAmount = abs(round($calculatedAmount, 2));

        $startDate = $request->is_monthly ? $request->start_date : today();
        $endDate = $request->is_monthly ? $request->end_date : today();

        $userService = UserService::create([
            'user_id' => $user->id,
            'quantity' => $request->quantity,
            'service_id' => $service->id,
            'amount' => $calculatedAmount,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $invoice = $this->createServiceInvoice($user, $userService, $calculatedAmount);
        $this->createServiceInvoiceRecord($invoice, $userService, $calculatedAmount);


        if ($request->send_sms) {

            if ($user->mobile) {
                $shekelAmount = Invoice::query()->where('amount_type', 2)->where('user_id', $user->id)->where('status', 0)->sum('amount');
                $dollarAmount = Invoice::query()->where('amount_type', 1)->where('user_id', $user->id)->where('status', 0)->sum('amount');
                $message = " تم اضافة خدمة" .  $service->name . ' ' . $calculatedAmount . ' ' . $service->currencyCd?->value;

                if ($dollarAmount > 0 && $shekelAmount > 0) {
                    $message .= "إجمالي المستحقات: {$dollarAmount} $ و {$shekelAmount}  ₪.";
                } elseif ($dollarAmount > 0) {
                    $message .= "إجمالي المستحقات: {$dollarAmount} $.";
                } elseif ($shekelAmount > 0) {
                    $message .= "إجمالي المستحقات: {$shekelAmount}  ₪.";
                }

                $this->smsService->sendSMS($user->mobile, $message);
            }
        }

        if ($request->service_id == 1) {
            $internet = SubscriptionInternet::query()
                ->where('status', 3)
                // ->where('branch_id', $user->branch_id)
                ->where('subscription_type_id', 7)
                ->first();

            if (!$internet) {
                return response()->json([
                    'status' => false,
                    'message' => 'لم يتم العثور على اشتراك إنترنت لنوع الاشتراك المحدد. تم إنشاء الفاتورة بنجاح، ولكن الاشتراك  انترنت غير موجود.'
                ], 404);
            }
            $internet->update([
                'status' => 1,
                'user_id' => $user->id,
            ]);
            $user->update([
                'code_internet' => $internet->internet_code,
            ]);
        }



        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function deleteService(Request $request)
    {
        UserService::query()->find($request->service_id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    /**
     * Get user attendance data
     */
    public function getAttendance(Request $request): JsonResponse
    {
        $data = Attendance::where('user_id', $request->user_id)
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($data)
            ->addColumn('login_time', fn($attendance) => $attendance->login_time ? Carbon::parse($attendance->login_time)->format('H:i') : '-')
            ->addColumn('logout_time', fn($attendance) => $attendance->logout_time ? Carbon::parse($attendance->logout_time)->format('H:i') : '-')
            ->make(true);
    }

    /**
     * Get total working hours for user
     */
    public function getTotalHours(Request $request): JsonResponse
    {
        $totalHours = $this->calculateTotalHours($request);
        return response()->json(['total_hours' => number_format($totalHours, 2)]);
    }

    /**
     * Export logs to Excel
     */
    public function exportLog(Request $request)
    {
        $logs = $this->getFilteredLogs($request);
        $fileName = 'logs_export_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new LogUserExport($logs), $fileName);
    }

    /**
     * Add join request to users
     */
    public function addRequestJoin(Request $request): JsonResponse
    {
        $requestJoin = JoinRequest::findOrFail($request->id);
        $this->createUserFromJoinRequest($requestJoin);
        $requestJoin->delete();

        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    /**
     * Export users to Excel
     */
    public function export(Request $request)
    {
        return Excel::download(
            new UsersExport(
                $request->input('status'),
                $request->input('company_id'),
                $request->input('displacement_place'),
                $request->input('branch_id'),
                $request->input('permanent_type')
            ),
            'users.xlsx'
        );
    }

    /**
     * Add user to branch
     */
    public function addToBranch(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'branch_id' => $request->branch_id,

            'status' => $request->status,
            'user_type_cd_id' => $request->user_type_cd_id
        ]);

        if (!$user->account_id) {
            $this->createUserAccount($user);
        }


        if ($request->status != 1) {
            $user->update([
                'desk_mangment_id' => null,
                'room_id' => null,


            ]);
            DeskMangment::query()->where('user_id', $request->user_id)->update([
                'user_id' => null,
            ]);
        }

        $desk = DeskMangment::query()->find($request->desk_mangment_id);

        if ($desk) {


            if ($desk->user_id) {

                DeskMangmentHistory::query()->where('desk_mangment_id', $desk->id)->where('user_id', $desk->user_id)->update([
                    'end_date' => today(),
                ]);
            }

            $user_before = User::query()->find($desk->user_id);
            $user_before->update([
                'desk_mangment_id' => null
            ]);

            DeskMangment::query()->where('user_id', $request->user_id)->update([
                'user_id' => null,
            ]);

            $desk->update([
                'user_id' => $user->id,
                'branch_id' => $request->branch_id,
            ]);

            $user->update([
                'desk_mangment_id' => $desk->id,
                'work_space_type' => 1,
                'work_space_id' => $desk->workSpaces->id,
            ]);

            $lastHistory = DeskMangmentHistory::where('desk_mangment_id', $desk->id)
                ->latest('id')
                ->first();

            if ($lastHistory) {
                $lastHistory->update(['end_date' => now()]);
            }

            DeskMangmentHistory::create([
                'user_id' => $request->user_id,
                'desk_mangment_id' => $desk->id,
                'start_date' => today(),
            ]);
        } else {
            $desk = DeskMangment::query()->where('user_id', $request->user_id)->update([
                'user_id' => null,
            ]);


            $user->update([
                'desk_mangment_id' => null,
                'work_space_type' => 1,
                'work_space_id' => null,
            ]);
        }


        if (!empty($user->mobile) && is_string($user->mobile) && $user->status == 1) {

            $message = "يسعدنا انضمامك لعائلة المبدعين والمستقلين، ونتمنى لك تجربة عمل مثمرة ومريحة معنا.";
            // $this->smsService->sendSMS($user->mobile, $message);
        }
        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    /**
     * Check and create invoice for users
     */
    public function checkAndCreateInvoice(Request $request): JsonResponse
    {
        $this->validateInvoiceDates($request);

        $users = User::query()->whereHas('deskMangment')
            ->where('status', 1)
            ->doesntHave('userRooms')
            ->doesntHave('rooms')
            ->get();

        foreach ($users as $user) {
            $amount = Service::query()->findOrFail(1)->amount;
            $this->processUserInvoice($user, $request, $amount);
        }

        $user_rooms = User::query()->whereHas('rooms')
            ->get();
        foreach ($user_rooms as $user) {
            $amount = $user->rooms()->sum('amount');

            if ($amount > 0) {
                $this->processUserInvoice($user, $request, $amount);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    /**
     * Store single invoice for user
     */
    public function storeSingleInvoice(Request $request): JsonResponse
    {
        $this->validateInvoiceDates($request);

        $user = User::findOrFail($request->user_id);
        $this->validateMonthlyInvoice($user, $request);

        $invoice = $this->createUserInvoice($user, $request);

        if (!$user->account_id) {
            $this->createUserAccount($user);
        }

        $this->createInvoiceTransaction($user, $invoice);
        $this->sendInvoiceNotification($user, $invoice);

        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    /**
     * Get workspaces by branch
     */
    public function getByBranch(Request $request): JsonResponse
    {
        $workSpaces = WorkSpace::where('branch_id', $request->branch_id)->get();
        return response()->json(['workSpaces' => $workSpaces]);
    }


    public function getByDeskMangments(Request $request): JsonResponse
    {
        $deskMangments = DeskMangment::query()
        ->doesntHave('rooms')
        ->where('work_space_id', $request->work_space_id)
            ->with(['users' => function ($query) {
                $query->select('id', 'name', 'desk_mangment_id');
            }])
            ->get();

        return response()->json(['deskMangments' => $deskMangments]);
    }


    /**
     * Get rooms by workspace
     */
    public function getByRooms(Request $request): JsonResponse
    {
        $rooms = Room::where('work_space_id', $request->work_space_id)->get();
        return response()->json(['rooms' => $rooms]);
    }

    /**
     * Add user to workspace
     */
    public function addToWorkSpace(Request $request): JsonResponse
    {
        User::where('id', $request->user_id)->update([
            'work_space_id' => $request->work_space_id,
            'work_space_type' => $request->work_space_type,
            'room_id' => $request->work_space_type == 2 ? $request->room_id : null,
            'desk_mangment_id' => $request->work_space_type == 2 ? $request->desk_mangment_id : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    /**
     * Calculate service amount
     */
    public function getAmount(Request $request): JsonResponse
    {
        $service = Service::findOrFail($request->service_id);
        $calculatedAmount = $this->calculateServiceAmount($service, $request);
        $serviceType = $service->currencyCd?->value;
        return response()->json([
            'status' => 200,
            'calculated_amount' => round($calculatedAmount, 2) . $serviceType,
            'total_amount' => round($calculatedAmount, 2),
        ]);
    }



    public function addExpense(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency_cd_id' => 'required|exists:constants,id',
            'expense_id' => 'required|exists:accounts,id',
            'child_expense_id' => 'required|exists:accounts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_method_id' => 'required',
        ]);

        // ✅ Create Expense Record
        $expense = Expense::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'currency_cd_id' => $validatedData['currency_cd_id'],
            'expense_id' => $validatedData['expense_id'],
            'child_expense_id' => $validatedData['child_expense_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'payment_method_id' => $validatedData['payment_method_id']
        ]);

        // ✅ Response
        return response()->json([
            'success' => true,
            'message' => __('label.expense_added_successfully'),
            'data' => $expense
        ]);
    }
    public function sendNotification(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->user_id);

        if ($user->mobile) {
            $shekelAmount = Invoice::query()->where('amount_type', 2)->where('user_id', $user->id)->where('status', 0)->sum('amount');
            $dollarAmount = Invoice::query()->where('amount_type', 1)->where('user_id', $user->id)->where('status', 0)->sum('amount');
            $message = " نرجو تسديد الفواتير المستحقة.";

            if ($dollarAmount > 0 && $shekelAmount > 0) {
                $message .= "إجمالي المستحقات: {$dollarAmount} $ و {$shekelAmount}  ₪.";
            } elseif ($dollarAmount > 0) {
                $message .= "إجمالي المستحقات: {$dollarAmount} $.";
            } elseif ($shekelAmount > 0) {
                $message .= "إجمالي المستحقات: {$shekelAmount}  ₪.";
            }

            $this->smsService->sendSMS($user->mobile, $message);
        }

        return response()->json([
            'success' => true,
            'message' => 'نجاح العملية'
        ], 201);
    }

    // ==================== PRIVATE HELPER METHODS ====================

    private function buildUserQuery(Request $request, $admin)
    {
        $query = User::query();

        switch ($request->status) {
            case 'non-hub':
                return $query->where('status', 3);
            case 'non-active':
                return $query->where('status', 0);
            case 'complete-profile':
                return $query->whereHas('projects')
                    ->whereNotNull('bio')
                    ->whereNotNull('skills');
            case 'inside-hub':
                return $query->where('status', 1)
                    ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id));
            default:
                return $query;
        }
    }

    private function getTotalContracts($admin, $branchId, $userIds)
    {
        return jobContract::whereHas('user', function ($q) use ($admin, $branchId) {
            $q->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
                ->when($branchId, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $branchId)));
        })
            ->whereIn('user_id', $userIds)
            ->sum('sallary');
    }

    private function getTotalMovements($admin, $branchId, $userIds)
    {
        return IncomeMovement::whereHas('user', function ($q) use ($admin, $branchId) {
            $q->when($admin->branch_id, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $admin->branch_id)))
                ->when($branchId, fn($q) => $q->whereHas('branch', fn($q) => $q->where('id', $branchId)));
        })
            ->whereIn('user_id', $userIds)
            ->sum('amount');
    }


    private function buildDataTablesQuery(Request $request, $admin)
    {

        // dd($admin->branch_id);

        $query = User::query()
            ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id))
            ->when($request->search['value'], fn($q) => $this->applySearch($q, $request->search['value']))
            ->when($request->company_id, fn($q) => $q->where('company_id', $request->company_id))
            ->when($request->user_type_cd_id, fn($q) => $q->where('user_type_cd_id', $request->user_type_cd_id))
            ->when($request->branch_id, fn($q) => $q->where('branch_id', $request->branch_id))
            ->when($request->workplace_attendance, fn($q) => $q->where('workplace_attendance',  $request->workplace_attendance))
            ->when($request->displacement_place, fn($q) => $q->whereIn('displacement_place', json_decode(str_replace("'", '"', $request->displacement_place))));



        $this->applyStatusFilter($query, $request->status, $admin);
        $this->applyOrdering($query, $request);

        return $query;
    }

    private function applySearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%")
                ->orWhere('mobile', 'like', "%$searchTerm%");
        });
    }

    private function applyStatusFilter($query, $status, $admin)
    {
        switch ($status) {
            case 'non-hub':
                $query->where('status', 3);
                break;
            case 'non-active':
                $query->where('status', 0)
                    ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id));
                break;
            case 'complete-profile':
                $query->whereHas('projects')
                    ->whereNotNull('bio')
                    ->whereNotNull('skills');
                break;
            case 'inside-hub':
                $query->where('status', 1)
                    ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id));
                break;
            case 'under-verification':
                $query->where('is_verification', 2);
                break;



            default:
                if ($admin->branch_id && !$status) {
                    $query->where(function ($q) use ($admin) {
                        $q->where('branch_id', $admin->branch_id)
                            ->where('status', 1)
                            ->orWhere('status', 3);
                    });
                }
        }
    }

    private function applyOrdering($query, $request)
    {
        if ($request->has('order')) {
            $order = $request->order[0];
            $column = $request->columns[$order['column']]['name'];
            $dir = $order['dir'];

            switch ($column) {
                case 'call_whatsapp_count':
                    $query->orderByRaw('(SELECT COUNT(*) FROM users_logs_whatsapp_click WHERE users_logs_whatsapp_click.user_id = users.id) ' . $dir);
                    break;
                case 'total_contracts':
                    $query->orderByRaw('(SELECT COUNT(*) FROM job_contracts WHERE job_contracts.user_id = users.id) ' . $dir);
                    break;
                case 'total_movements':
                    $query->orderByRaw('(SELECT SUM(amount) FROM income_movements WHERE income_movements.user_id = users.id) ' . $dir);
                    break;
                case 'total_work_hours':
                    $query->orderByRaw('(SELECT SUM(hours) FROM attendances WHERE attendances.user_id = users.id) ' . $dir);
                    break;
                case 'total_invoice':
                    $query->orderByRaw('(SELECT SUM(amount) FROM invoices WHERE invoices.user_id = users.id AND invoices.status = "0") ' . $dir);
                    break;
                default:
                    $query->orderBy($column, $dir);
            }
        } else {
            $query->orderBy('id', 'desc');
        }
    }

    private function getUserNameColumn(): \Closure
    {
        return function ($user) {
            $branchName = $user->deskMangment?->branches?->name;
            $branchName = $branchName ? "اسم الفرع: $branchName" : '';

            $deskInfo = '';
            if ($user->rooms()->exists()) {
                $room = $user->rooms()->orderby('created_at', 'desc')->first();
                $deskCode = $room?->code ?? '';
                $deskInfo = ($deskCode) ? "غرفة: $deskCode" : '';
            }
            if ($user->userRooms()->exists()) {
                $userRoom = $user->userRooms()->orderBy('created_at', 'desc')->first();
                $deskCode = optional($userRoom?->rooms)->code ?? '';
                $deskInfo = ($deskCode) ? "غرفة: $deskCode" : '';
            } elseif ($user->deskMangment()->exists()) {
                $deskCode = $user->deskMangment?->code ?? '';
                $deskInfo = $deskCode ? "رقم المقعد:$deskCode" : '';
            }

            $hasRooms = $user->userRooms()->exists() || $user->rooms()->exists();

            // إذا كان للمستخدم غرفة، أضف اسم مدير الغرفة
            if ($hasRooms) {
                // جلب الغرفة (من userRooms أو rooms)
                $room = $user->userRooms()->exists()
                    ? optional($user->userRooms()->orderBy('created_at', 'desc')->first())->rooms
                    : $user->rooms()->orderBy('created_at', 'desc')->first();

                if ($room && $room->user_id) {
                    $manager = \App\Models\User::find($room->user_id);
                    if ($manager) {
                        $deskInfo .= '<br>مدير الغرفة: ' . e($manager->name);
                    }
                }
            }

            // Add verification icon if user is verified
            $verificationIcon = '';
            if ($user->verificationIcon == 1) {
                $verificationIcon = '<span title="Verified" style="color:green;"><i class="fas fa-check-circle"></i></span> ';
            }
            $permanentTypeLabel = $user->permanentType();

            return '<a href="#" class="text-dark-30 font-weight-bolder text-hover-primary mb-1 font-size-lg">'
                . e($user->name) . '</a>'
                . '<div><a class="text-muted font-weight-bold text-hover-primary" href="#">'
                . e($user->email) . '</a></div>'
                . '<div class="text-muted">' . e($branchName) . '</div>'
                . '<div class="text-muted">' . $deskInfo . '</div>'
                . '<div class="text-muted">' . $verificationIcon . '</div>'
                . '<div class="text-muted">' . e($permanentTypeLabel) . '</div>';
        };
    }


    private function getPhotoColumn(): \Closure
    {
        return function ($user) {
            // If the request is for under-verification users, show identity image in modal, else show profile photo
            $request = request();
            if ($request->status === 'under-verification') {
                $photoUrl = $user->getIdPhoto();
                return '<a href="#" class="show-photo-modal" data-photo="' . $photoUrl . '">'
                    . '<img src="' . $photoUrl . '" class="circle" '
                    . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                    . '</a>';
            } else {
                $photoUrl = $user->getPhoto();
                return '<a href="' . route('admin.users.views', $user->id) . '">'
                    . '<img src="' . $photoUrl . '" class="circle" '
                    . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                    . '</a>';
            }
        };
    }

    private function getWhatsappColumn(): \Closure
    {
        return function ($user) {
            return '<a href="https://wa.me/' . $user->whatsapp . '" target="_blank">'
                . '<i class="fab fa-whatsapp-square" style="font-size: 35px;"></i>'
                . '</a>';
        };
    }

    private function createUser(Request $request): User
    {

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'specialization_id' => $request->specialization_id,
            // 'sallary' => $request->sallary,
            // 'company_id' => $request->company_id,
            // 'marital_status' => $request->marital_status,
            // 'displacement_place' => $request->displacement_place,
            'original_place' => $request->original_place,
            'status' => intval($request->status),
            'password' => Hash::make($request->password),
            'branch_id' => $request->branch_id,
            // 'permanent_type' => $request->permanent_type,
            'workplace_attendance' => $request->workplace_attendance,
            'user_type_cd_id' => $request->user_type_cd_id,
        ]);

        if ($request->hasFile('photo')) {
            $user->update(['photo' => upload($request->photo)]);
        }
        return $user;
    }

    private function updateUser(User $user, Request $request): void
    {
        if ($request->hasFile('photo')) {
            $user->update(['photo' => upload($request->photo)]);
        }

        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'specialization_id' => $request->specialization_id,
            // 'sallary' => $request->sallary,
            // 'company_id' => $request->company_id,
            // 'marital_status' => $request->marital_status,
            // 'displacement_place' => $request->displacement_place,
            'original_place' => $request->original_place,
            'status' => intval($request->status),
            'branch_id' => $request->branch_id,
            // 'permanent_type' => $request->permanent_type,
            'workplace_attendance' => $request->workplace_attendance,
            'user_type_cd_id' => $request->user_type_cd_id,
        ]);


        if ($request->status != 1) {
            $user->update([
                'work_space_id' => null,
                'work_space_type' => null,
                'desk_mangment_id' => null,
                'room_id' => null,
                'branch_id' => null,
                'workplace_attendance' => null,


            ]);
        }
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // if (isset($request->attachment)) {
        //     foreach ($request->attachment as $file) {
        //         Attachment::create([
        //             'user_id' => $user->id,
        //             'file' => upload($file)
        //         ]);
        //     }
        // }
    }

    private function logActivity(string $message, $subject): void
    {
        activity()
            ->performedOn($subject)
            ->causedBy(auth('admin')->user())
            ->log($message);
    }
    private function calculateServiceAmount(Service $service, $request): float
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Total days in the month of the start date
        $daysInMonth = $startDate->daysInMonth;

        // Calculate remaining days between the two dates
        $remainingDays = $endDate->greaterThanOrEqualTo($startDate)
            ? $endDate->diffInDays($startDate, true) + 1
            : 0;
        // Ensure the remaining days do not exceed the total days of the month
        $remainingDays = min($remainingDays, $daysInMonth);

        $remainingDays = $remainingDays > 26 ? 26 : $remainingDays;


        if ($service->is_monthly) {


            $proRatedAmount = ($service->amount / 26) * $remainingDays * $request->quantity;
        } else {
            $proRatedAmount = $service->amount  * $request->quantity;
        }



        return $proRatedAmount;
    }


    private function createServiceInvoice($user,  $user_service, float $amount): Invoice
    {

        $service = Service::find($user_service->service_id);
        return      $invoice = Invoice::create([
            'user_id' => $user->id,
            'amount' => abs(round($amount, 2)),
            'amount_type' => $service->currency_cd_id,
            'status' => 0,
            'due_date' => $user_service->end_date,
            'expiration_date' => $user_service->start_date,
        ]);
    }

    private function createServiceInvoiceRecord(Invoice $invoice, UserService $userService, float $amount): void
    {
        ServiceInvoice::create([
            'invocie_id' => $invoice->id,
            'user_service_id' => $userService->id,
            'amount' => abs(round($amount, 2)),
        ]);
    }

    private function sendServiceNotification(User $user, float $amount, int $amountType): void
    {
        if ($user->mobile) {
            $type = $amountType == 1 ? 'دولار' : 'شيكل';
            $message = "تم إصدار فاتورة مستحقة بقيمة $amount $type.";
            $this->smsService->sendSMS($user->mobile, $message);
        }
    }

    private function calculateTotalHours(Request $request): float
    {
        $attendanceHours = Attendance::query()
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('date', [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                ]);
            })
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->sum('hours');

        $logHours = Log::query()
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('date', [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                ]);
            })
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->sum('duration') / 60;

        return $logHours + $attendanceHours;
    }

    private function getFilteredLogs(Request $request)
    {
        return Log::query()
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('date', [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                ]);
            })
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->get();
    }

    private function createUserFromJoinRequest(JoinRequest $requestJoin): void
    {
        User::create([
            'name' => $requestJoin->name,
            'mobile' => $requestJoin->phone,
            'whatsapp' => $requestJoin->whatsapp,
            'email' => $requestJoin->email,
            'job' => $requestJoin->job,
            'displacement_place' => $requestJoin->current_city,
            'original_place' => $requestJoin->old_city,
            'status' => 3,
            'photo' => $requestJoin->image,
            'password' => Hash::make('123456'),
        ]);
    }

    private function createUserAccount(User $user): void
    {



        $parent = Account::where('code', 41000)->firstOrFail();
        $lastChild = Account::where('parent_id', $parent->id)
            ->orderBy('code', 'desc')
            ->first();

        $newCode = $this->generateAccountCode($parent, $lastChild);

        $account = Account::create([
            'name' => $user->name,
            'code' => $newCode,
            'parent_id' => $parent->id,
            'type_id' => $parent->type_id,
            'balance_type_id' => $parent->balance_type_id,
            'user_id' => $user->id,
        ]);

        $user->update(['account_id' => $account->id]);
    }

    private function generateAccountCode($parent, $lastChild): int
    {
        if (is_null($parent->parent_id)) {
            // Main account
            return $lastChild
                ? $lastChild->code + 1000
                : (intval(substr($parent->code, 0, 2)) + 1) * 1000;
        }

        // Sub account
        return $lastChild
            ? $lastChild->code + 1
            : ($parent->code * 10) + 1;
    }

    private function validateInvoiceDates(Request $request): void
    {
        $expirationDate = Carbon::parse($request->expiration_date);
        $dueDate = Carbon::parse($request->due_date);

        if ($dueDate->lte($expirationDate)) {
            abort(422, 'تاريخ الانتهاء اقل من تاريخ الاستحقاق');
        }
    }

    private function processUserInvoice(User $user, Request $request, $amount = null): void
    {
        // dd($user);
        $expirationDate = Carbon::parse($request->expiration_date);

        $invoiceExists = Invoice::where('user_id', $user->id)
            ->whereYear('expiration_date', $expirationDate->year)
            ->whereMonth('expiration_date', $expirationDate->month)
            ->exists();

        if (!$invoiceExists) {
            $invoice = $this->createUserInvoice($user, $request, $amount);

            if (!$user->account_id) {
                $this->createUserAccount($user);
            }

            $this->createInvoiceTransaction($user, $invoice);
            $this->sendInvoiceNotification($user, $invoice);
        }
    }

    private function createUserInvoice(User $user, Request $request, $amount = null): Invoice
    {

        $amount = $amount ?? $request->amount;
        return Invoice::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'amount_type' => $request->amout_type,
            'status' => 0,
            'due_date' => Carbon::parse($request->due_date)->format('Y-m-d'),
            'expiration_date' => Carbon::parse($request->expiration_date)->format('Y-m-d'),
        ]);
    }

    private function validateMonthlyInvoice(User $user, Request $request): void
    {
        $expirationDate = Carbon::parse($request->expiration_date);

        $invoiceExists = Invoice::where('user_id', $user->id)
            ->whereYear('expiration_date', $expirationDate->year)
            ->whereMonth('expiration_date', $expirationDate->month)
            ->exists();

        // if ($invoiceExists) {
        //     abort(400, 'لم يتم تنفيذ العملية بنجاح، لا يمكن إضافة اكثر من فاتورة مسحقة عن الشهر الحالي');
        // }
    }

    private function createInvoiceTransaction(User $user, Invoice $invoice): void
    {
        $account = Account::where('code', 41000)->firstOrFail();

        Transaction::create([
            'date' => today(),
            'amount' => $invoice->amount,
            'form_account_id' => $account->id,
            'to_account_id' => $user->account_id,
            'balance_type_id' => 6,
            'invoice_id' => $invoice->id,
        ]);
    }


    public  function storeSingleInvoce(Request $request)
    {
        $expiration_date = Carbon::parse($request->expiration_date);

        $invoice = Invoice::query()->where('user_id', $request->user_id)
            ->whereYear('expiration_date', $expiration_date->year)
            ->whereMonth('expiration_date', $expiration_date->month)
            ->first();


        $expiration_date = Carbon::parse($request->expiration_date)->format('Y-m-d');
        $due_date = Carbon::parse($request->due_date)->format('Y-m-d');

        if ($due_date <= $expiration_date) {
            return response_web(false, 'تاريخ الانتهاء اقل من تاريخ الاستحقاق', [], 422);
        }
        // if ($invoice) {
        //     return response_web(false, 'لم يتم تنفيذ العملية بنجاح، لا يمكن إضافة اكثر من فاتورة مسحقة عن الشهر الحالي', [], 400);
        // }
        $user = User::query()->where('id', $request->user_id)->first();

        $amount = $request->amount;

        $invoice = Invoice::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 0, // الحالة الافتراضية
            'amount_type' => $request->amout_type,
            'due_date' => Carbon::parse($request->due_date)->format('Y-m-d'),
            'expiration_date' => Carbon::parse($request->expiration_date)->format('Y-m-d'),
        ]);
        if ($user && $user->mobile) {
            $this->sendInvoiceNotification($user, $invoice);
        }
        return response_web(true, 'نجاح العملية', [], 201);
    }

    public function getLog(Request $request)
    {


        $data = Log::query()
            ->where('user_id', $request->user_id)
            // ->when($search, function ($q) use ($search) {

            //     $q->where('mobile', 'like', '%' . $search . '%')->orwhereHas('users', function ($q) use ($search) {
            //         $q->where('name','like', '%' . $search . '%' );
            //     });
            // })

            // ->when($request->branch_id, function ($q) use ($request) {
            //     $branch=Branch::query()->where('id',$request->branch_id)->first();

            //     $q->where('ip_address', $branch?->ip_address);
            // })
            ->when($request->date, function ($q) use ($request) {
                // $date = Carbon::createFromFormat('m/d/y', $request->date)->format('Y-m-d');
                $q->whereDate('date', $request->date);
            })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('date', [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                ]);
            });

        if ($request->order_by && $request->order_direction) {
            $orderBy = $request->order_by;
            $orderDirection = $request->order_direction;

            if (in_array($orderBy, ['name', 'hours']) && in_array($orderDirection, ['asc', 'desc'])) {
                if ($orderBy == 'name') {
                    $data = $data->join('users', 'logs.user_id', '=', 'users.id')
                        ->orderBy('users.name', $orderDirection);
                } elseif ($orderBy == 'hours') {
                    $data = $data->orderBy(DB::raw('TIMESTAMPDIFF(HOUR, time_in, time_out)'), $orderDirection);
                }
            } else {
                $data = $data->orderBy('user_id', 'asc');
            }
        } else {
            $data = $data->orderBy('user_id', 'asc');
        }
        $data = $data->get();


        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
                $photoUrl = $data->users?->getPhoto() ?? asset('assets/default.png');
                return '<a href="' . route('admin.users.views', $data->user_id ?? '') . '"><img src="' . $photoUrl . '" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;"></a>';
            })

            ->addColumn('name', function ($row) {
                return $row->users?->name;
            })
            ->addColumn('mobile', function ($row) {
                return $row->mobile;
            })

            ->addColumn('completed_invoice', function ($row) {
                return $row->users?->invoices?->where('status', 1)->sum('amount');
            })

            ->addColumn('pendding_invoice', function ($row) {
                return $row->users?->invoices?->where('status', 0)->sum('amount');
            })
            ->addColumn('branch', function ($row) {
                // return $row->ip_address;
                $branch = Branch::query()->where('ip_address', $row->ip_address)->first();

                return $branch?->name;
            })
            ->addColumn('time_in', function ($row) {
                return $row->time_in;
            })
            ->addColumn('time_out', function ($row) {
                return $row->time_out;
            })
            ->addColumn('hours', function ($row) {
                $timeIn = Carbon::parse($row->time_in);
                $timeOut = Carbon::parse($row->time_out);
                return $timeOut->diffInHours($timeIn) . ' ساعات ' . ':' . $timeOut->diffInMinutes($timeIn) % 60 . ' دقائق ';
            })

            ->addColumn('action', function ($data) {

                return view('admin.logs.partials.actions', compact('data'));
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }
    private function sendInvoiceNotification(User $user, Invoice $invoice): void
    {
        if ($user->mobile) {
            $amountType = $invoice->amount_type == 1 ? 'دولار' : 'شيكل';
            $skekel_amount = Invoice::query()->where('amount_type', 2)->where('user_id', $user->id)->where('status', 0)->sum('amount');
            $dollar_amount = Invoice::query()->where('amount_type', 1)->where('user_id', $user->id)->where('status', 0)->sum('amount');
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

    public function addSubscription(addSubscriptionRequest $request)
    {
        $user = User::query()->where('id', $request->user_id)->first();
        $internet = SubscriptionInternet::query()
            ->where('status', 3)
            // ->where('branch_id', $user->branch_id)
            ->where('subscription_type_id', $request->subscription_type_id)
            ->first();

        if (!$internet) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم العثور على اشتراك الإنترنت لنوع الاشتراك المحدد.'
            ], 404);
        }
        $internet->update([
            'status' => 1,
            'user_id' => $user->id,
        ]);
        $user->update([
            'code_internet' => $internet->internet_code,
        ]);



        if (!$user->mobile) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم العثور على رقم الجوال.'
            ], 404);
        }

        $message = "رقم الحساب الخاص بك هو: {$internet->internet_code}\nكلمة المرور: {$internet->internet_password}";

        $this->smsService->sendSMS($user->mobile, $message);


        return response()->json([
            'status' => true,
            'message' => 'Subscription added successfully.'
        ], 201);
    }


    public function restoreUsers(Request $request)
    {
        $user = User::withTrashed()->findOrFail($request->user_id);

        $user->restore();

        return response()->json([
            'status' => true,
            'message' => 'تم استرجاع المستخدم بنجاح.'
        ]);
    }



    public function userTYpeAccount()
    {
        $parent = Account::where('code', 41000)->firstOrFail();
        $userTypes = [
            '4110000' => 'خدمات مقعد',
            '4120000' => 'طلاب',
            '4130000' =>  'مولد',
            '4140000' => 'اشتراك انترنت',
            '4150000' => 'كفي شوب',
            '4160000' => 'المبيعات',
            '4170000' => 'خدمات تكنولوجيا',
            '4180000' => 'اخرى',


        ];


        foreach ($userTypes as $newCode => $typeName) {
            Account::updateOrCreate(
                ['name' => $typeName], // شرط البحث
                [
                    'code' => $newCode,
                    'parent_id' => $parent->id,
                    'type_id' => $parent->type_id,
                    'balance_type_id' => $parent->balance_type_id,
                ]
            );
        }

        return 'تم التحديث أو الإنشاء بنجاح';
    }


    public function getWallet(Request $request): JsonResponse
    {
        $data = WalletRecipt::query()
            ->whereHas('wallet', function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->orderBy('id', 'desc')
            ->get();



        return DataTables::of($data)
            ->addColumn('status', fn($data) => $data->getStatus())

            ->addColumn('date', fn($data) => $data->created_at->format('Y-m-d'))
            ->addColumn('logo', fn($data) => $data->getAttachment())
            ->addColumn('action', fn($data) => view('admin.users.partials.wallet_actions', compact('data')))


            ->rawColumns(['logo', 'status', 'action'])

            ->make(true);
    }
    public function updateAccountUser()
    {

        $account = Account::query()->where('parent_id', '52')->get();
        return     $parent = Account::where('parent_id', 499)->get();
        foreach ($account as $value) {
            $lastChild = Account::where('parent_id', $parent->id)
                ->orderBy('code', 'desc')
                ->first();

            $newCode = $this->generateAccountCode($parent, $lastChild);

            $value->update([
                'parent_id' => 499,
                'code' => $newCode,
            ]);
        }
    }

    public function updateWallet(Request $request)
    {
        $walletRecipt = walletRecipt::query()->where('id', $request->wallet_id)->firstOrFail();



        // If approved (status_cd_id == 1), update wallet balance
        if ($request->status_cd_id == 1 && ($walletRecipt->status_cd_id != $request->status_cd_id)) {
            $wallet = Wallet::firstOrNew(['user_id' => $walletRecipt->wallet->user_id]);
            if ($wallet->exists) {
                $wallet->increment('balance', $request->amount);
            }
        }

        $walletRecipt->update([
            'status_cd_id' => $request->status_cd_id,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function addBalance(Request $request)
    {


        $wallet = Wallet::firstOrNew(
            ['user_id' => $request->user_id]
        );

        if ($wallet->exists) {
            // If it already exists, increment the balance
            $wallet->increment('balance', $request->amount);
        } else {
            // If it doesn't exist, set initial balance and save
            $wallet->balance = $request->amount;
            $wallet->save();
        }

        $photo = null;
        if ($request->photo) {
            $photo = $request->file('photo')->store('wallet', 'public');
        }
        walletRecipt::query()->create([
            'wallet_id' => $wallet->id,
            'status_cd_id' => 1,
            'amount' => $request->amount,
            'photo' => $photo,
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
    public function showDetails(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'user_id'        => $user->id,
            'first_name'      => $user->first_name ?? '',
            'second_name'     => $user->second_name ?? '',
            'third_name'      => $user->third_name ?? '',
            'last_name'       => $user->last_name ?? '',
            'birth_date'      => $user->birth_date ?? '',
            'id_number' => $user->id_number ?? '',
            'identity_image_url' => $user->getIdPhoto(),
            'is_verifivation' => $user->is_verification ?? 0,
        ]);
    }

    public function postVerification(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->update([
            'is_verification' => $request->is_verification,
        ]);
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
}
