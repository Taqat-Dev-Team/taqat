<?php

namespace App\Http\Controllers\Admin\WorkSpaceMangments\DeskMangments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkSpaceMangments\DeskSpaceMangments\DeskMangmentRequest;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\DeskMangment;
use App\Models\DeskMangmentHistory;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\SubscriptionInternet;
use App\Models\SubscriptionType;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDeskMangment;
use App\Models\UserRoom;
use App\Models\WorkSpace;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeskMangmentsControlller extends Controller
{


    protected SmsService $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Display the desk management index page
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('admin.workSpaceMangements.deskMangments.index', [
            'workSpaces' => WorkSpace::all(),
            'branches' => Branch::all(),
            'subscriptionTypes' => SubscriptionType::all(),
            'work_space_id' => $request->work_space_id,
            'branch_id' => $request->branch_id,
            'currencies' => Constant::query()->where('key', 'currency')->whereNotNull('parent_id')->get(),

        ]);
    }

    /**
     * Get desk data for DataTables
     */
    public function getIndex(Request $request): JsonResponse
    {
        $desks = $this->getFilteredDesks($request);
        $sortedDesks = $this->applySorting($desks, $request);

        return datatables()->of($sortedDesks)
            ->addColumn('work_space_name', fn($data) => $data->workSpaces?->name)
            ->addColumn('photo', $this->getPhotoColumn())
            ->addColumn('branch_name', fn($data) => $data->branches?->name)
            ->addColumn('user_name', fn($data) => $data->users?->name)
            ->addColumn('internet_code', $this->getInternetCode())
            ->addColumn('internet_password', $this->getInternetPassword())
            ->addColumn('invoice_not_paid', fn($data) => $data->users?->totalInvoiceNotPaid())
            ->addColumn('action', $this->getActionColumn())
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    /**
     * Store a new desk management record
     */
    public function store(DeskMangmentRequest $request): JsonResponse
    {
        try {
            $desk = $this->createDesk($request);
            // $this->handleUserAssignment($request, $desk);
            // $this->updateWorkspaceDeskCount($desk->workSpace);

            return $this->successResponse(__('label.success_full_process'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update an existing desk management record
     */
    public function update(DeskMangmentRequest $request): JsonResponse
    {
        try {
            $desk = DeskMangment::findOrFail($request->desk_mangment_id);
            $this->updateDesk($desk, $request);

            return $this->successResponse(__('label.success_full_process'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Delete a desk management record
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            $desk = DeskMangment::findOrFail($request->id);
            $desk->delete();
            $this->updateWorkspaceDeskCount($desk->workSpace);

            return $this->successResponse(__('label.delete_elemnet_success_full'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Generate a new desk code
     */
    public function getCode(Request $request): JsonResponse
    {
        $workSpace = WorkSpace::findOrFail($request->work_space_id);
        $newCode = $this->generateDeskCode($workSpace);

        return response()->json([
            'success' => true,
            'new_code' => $newCode,
        ]);
    }

    /**
     * Release a desk from user assignment
     */
    public function release(Request $request): JsonResponse
    {
        $desk = DeskMangment::findOrFail($request->desk_mangment_id);
        $this->releaseDesk($desk);

        return $this->successResponse(__('label.success_full_process'));
    }

    /**
     * Get workspaces by branch
     */
    public function getWorkSpaces(Request $request): JsonResponse
    {
        $workSpaces = WorkSpace::where('branch_id', $request->branch_id)->get();

        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
        ]);
    }

    /**
     * Get users by workspace
     */
    public function getUsers(Request $request): JsonResponse
    {
        $workSpace = WorkSpace::findOrFail($request->work_space_id);
        $users = User::where('branch_id', $workSpace->branch_id)->get();

        return response()->json(['users' => $users]);
    }

    /**
     * Handle internet subscription
     */
    public function subscriptionInternet(Request $request): JsonResponse
    {
        $desk = DeskMangment::findOrFail($request->desk_mangment_id);
        $this->updateDeskSubscription($desk, $request);
        // $this->createInternetSubscription($desk, $request);


        if ($desk->user_id) {
            $user = User::query()->where('id', $desk->user_id)->first();
            $internet = SubscriptionInternet::query()
                ->where('status', 3)
                // ->where('branch_id', $user->branch_id)
                ->where('subscription_type_id', $request->subscription_type_id)
                ->first();

            // dd($internet);
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
        }
        return $this->successResponse(__('label.success_full_process'));
    }

    /**
     * Get desk history
     */
    public function getDeskHistories(Request $request): JsonResponse
    {
        $histories = DeskMangmentHistory::with('users')
            ->where('desk_mangment_id', $request->desk_mangment_id)
            ->get(['user_id', 'start_date', 'end_date']);

        return response()->json([
            'success' => true,
            'histories' => $histories
        ]);
    }

    /**
     * Get user desk information
     */
    public function getUserDeskInfo(Request $request): JsonResponse
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return $this->errorResponse(__('label.user_not_found'));
        }

        $desk = DeskMangment::where('user_id', $user->id)->first();

        if (!$desk) {
            return $this->errorResponse(__('label.no_desk_found_for_user'));
        }

        return response()->json([
            'success' => true,
            'desk_code' => $desk->code,
            'branch_name' => $desk->branches?->name,
        ]);
    }

    // ==================== PRIVATE METHODS ====================

    private function getFilteredDesks(Request $request)
    {
        return DeskMangment::with(['users.subscriptionInternets', 'workSpaces', 'branches'])
            ->whereNull('room_id')
            ->when($request->work_space_id, fn($q) => $q->where('work_space_id', $request->work_space_id))
            ->when($request->branch_id, fn($q) => $q->where('branch_id', $request->branch_id))
            ->get();
    }

    private function applySorting($collection, Request $request)
    {
        if (!$request->has('order')) {
            return $collection;
        }

        foreach ($request->order as $order) {
            $column = $request->columns[$order['column']]['data'];
            $direction = $order['dir'];

            $collection = match ($column) {
                'user_name' => $this->sortByName($collection, $direction),
                'internet_code' => $this->sortByInternetCode($collection, $direction),
                'internet_password' => $this->sortByInternetPassword($collection, $direction),
                'invoice_not_paid' => $this->sortByUnpaidInvoices($collection, $direction),
                default => $collection,
            };
        }

        return $collection->values();
    }

    private function sortByName($collection, string $direction)
    {
        return $collection->sortBy(
            fn($item) => $item->users?->name ?? '',
            SORT_REGULAR,
            $direction === 'desc'
        );
    }

    private function sortByInternetCode($collection, string $direction)
    {
        return $collection->sortBy(
            fn($item) => $item->users?->subscriptionInternets->sortByDesc('id')->first()?->internet_code ?? '',
            SORT_REGULAR,
            $direction === 'desc'
        );
    }

    private function sortByInternetPassword($collection, string $direction)
    {
        return $collection->sortBy(
            fn($item) => $item->users?->subscriptionInternets->sortByDesc('id')->first()?->internet_password ?? '',
            SORT_REGULAR,
            $direction === 'desc'
        );
    }

    private function sortByUnpaidInvoices($collection, string $direction)
    {
        return $collection->sortBy(
            fn($item) => $item->users?->totalInvoiceNotPaid() ?? 0,
            SORT_REGULAR,
            $direction === 'desc'
        );
    }

    private function getPhotoColumn(): \Closure
    {
        return fn($data) => '<a href="' . route('admin.users.views', $data->user_id) . '">
            <img src="' . ($data->users?->getPhoto() ?? asset('assets/default.png')) . '"
                 class="circle" style="object-fit:contain;width:70px;height:70px;border-radius:50%;">
        </a>';
    }

    private function getInternetCode(): \Closure
    {
        return fn($data) => optional($data->users?->subscriptionInternets->sortByDesc('id')->first())->internet_code;
    }

    private function getInternetPassword(): \Closure
    {
        return fn($data) => optional($data->users?->subscriptionInternets->sortByDesc('id')->first())->internet_password;
    }

    private function getActionColumn(): \Closure
    {
        return fn($data) => view('admin.workSpaceMangements.deskMangments.partials.actions', compact('data'));
    }

    private function createDesk(DeskMangmentRequest $request): DeskMangment
    {
        $workSpace = WorkSpace::findOrFail($request->work_space_id);

        return DeskMangment::create([
            'code' => $request->code,
            'work_space_id' => $workSpace->id,
            'user_id' => $request->user_id,
            'internet_code' => rand(1, 9999999),
            'branch_id' => $workSpace->branch_id,
            'start_date' => $request->start_date,
            'end_date' => $request->start_date,
            'subscription_type_id' => $request->subscription_type_id,
        ]);
    }

    private function handleUserAssignment(DeskMangmentRequest $request, DeskMangment $desk): void
    {
        if (!$request->user_id) {
            return;
        }

        $user = User::findOrFail($request->user_id);
        $this->validateUserForDeskAssignment($user);

        $user->update([
            'desk_mangment_id' => $desk->id,
            'work_space_type' => 1,
            'work_space_id' => $desk->work_space_id,
        ]);

        $this->createUserAccountIfNotExists($user);
        $this->createUserDeskRecord($user, $desk, $request);

        if ($request->send_invoice) {
            $this->createInvoiceForUser($user, $request);
        }
    }

    private function validateUserForDeskAssignment(User $user): void
    {
        if ($user->desk_mangment_id) {
            throw new \Exception(__('messages.user_already_has_desk'));
        }
    }

    private function createUserAccountIfNotExists(User $user): void
    {
        if ($user->account_id) {
            return;
        }

        $parentAccount = Account::where('code', 41000)->firstOrFail();
        $lastChild = Account::where('parent_id', $parentAccount->id)->latest('code')->first();

        $newCode = $lastChild
            ? ($parentAccount->parent_id ? $lastChild->code + 1 : $lastChild->code + 1000)
            : ($parentAccount->parent_id
                ? ($parentAccount->code * 10) + 1
                : (intval(substr($parentAccount->code, 0, 2)) + 1) * 1000);

        $account = Account::create([
            'name' => $user->name,
            'code' => $newCode,
            'parent_id' => $parentAccount->id,
            'type_id' => $parentAccount->type_id,
            'balance_type_id' => $parentAccount->balance_type_id,
            'user_id' => $user->id,
        ]);

        $user->update(['account_id' => $account->id]);
    }

    private function createUserDeskRecord(User $user, DeskMangment $desk, DeskMangmentRequest $request): void
    {
        UserDeskMangment::create([
            'user_id' => $user->id,
            'desk_mangment_id' => $desk->id,
            'subscription_type_id' => $request->subscription_type_id,
            'status' => 0,
        ]);
    }

    private function createInvoiceForUser(User $user, DeskMangmentRequest $request): void
    {
        $service=Service::query()->find(1);
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'amount' => $service->amount,
            'amount_type' => $service->currency_cd_id,
            'status' => 0,
            'due_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
            'expiration_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
        ]);

        $account = Account::where('code', 41000)->firstOrFail();

        Transaction::create([
            'date' => today(),
            'amount' => $service->amount,
            'form_account_id' => $account->id,
            'to_account_id' => $user->account_id,
            'balance_type_id' => 6,
            'invoice_id' => $invoice->id,
        ]);

        if ($user->mobile) {


            $amountType = $invoice->amount_type == 1 ? 'دولار' : 'شيكل';
            $skekel_amount = Invoice::query()->where('amount_type', 2)->where('user_id', $user->id)
                ->where('status', 0)->sum('amount');
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

    private function updateWorkspaceDeskCount(WorkSpace $workSpace): void
    {
        $workSpace->update([
            'desk_count' => $workSpace->deskMangments()->count(),
        ]);
    }

    private function updateDesk(DeskMangment $desk, DeskMangmentRequest $request): void
    {
        $workSpace = $desk->workSpaces;
        $oldUserId = $desk->user_id;

        if ($oldUserId != $request->user_id || $desk->user_id == null) {

            DeskMangment::query()->where('user_id', $request->user_id)->update([
                'user_id' => null,
            ]);
        }
        $desk->update([
            'user_id' => $request->user_id,
            'branch_id' => $workSpace->branch_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'subscription_type_id' => $request->subscription_type_id,
        ]);

        if ($request->user_id) {
            $this->handleUserUpdate($request, $desk, $oldUserId);
        }
    }

    private function handleUserUpdate(DeskMangmentRequest $request, DeskMangment $desk, $oldUserId): void
    {
        $user = User::findOrFail($request->user_id);
        $this->createUserAccountIfNotExists($user);

        if ($request->send_invoice) {
            $this->createInvoiceForUser($user, $request);
        }

        if ($request->send_internet) {
            $this->sendInternetCredentials($user, $desk, $request);
        }

        if ($oldUserId != $request->user_id) {

            $this->createDeskHistory($desk, $request);
        }

        $user->update([
            'desk_mangment_id' => $desk->id,
            'work_space_type' => 1,
            'work_space_id' => $desk->workSpaces->id,
        ]);
    }

    private function sendInternetCredentials(User $user, DeskMangment $desk, $request): void
    {
        $subscription = SubscriptionInternet::where('status', 3)
            // ->where('branch_id', $user->branch_id)
            ->first();

        if ($user->mobile && $subscription) {

            $message = "اسم المستخدم: {$subscription->internet_code} كلمة المرور: {$subscription->internet_password}.\n";

            $this->smsService->sendSMS($user->mobile, $message);
        }

        $desk->update([
            'subscription_type_id' => $request->subscription_type_id,
        ]);
    }

    private function createDeskHistory(DeskMangment $desk, DeskMangmentRequest $request): void
    {
        $lastHistory = DeskMangmentHistory::where('desk_mangment_id', $desk->id)
            ->latest('id')
            ->first();

        if ($lastHistory) {
            $lastHistory->update(['end_date' => now()]);
        }

        DeskMangmentHistory::create([
            'user_id' => $request->user_id,
            'desk_mangment_id' => $desk->id,
            'start_date' => $request->start_date,
        ]);
    }

    private function generateDeskCode(WorkSpace $workSpace): string
    {
        $lastDesk = DeskMangment::whereNull('room_id')
            ->where('work_space_id', $workSpace->id)
            ->latest('id')
            ->first();

        $lastCode = $lastDesk ? $lastDesk->code : $workSpace->code . '-T000';
        $lastCodeParts = explode('-', $lastCode);
        $lastCodeNumber = (int) substr(end($lastCodeParts), 1);
        $newCodeNumber = $lastCodeNumber + 1;

        return sprintf(
            '%s-%s-T%03d',
            $workSpace->branch->code,
            $workSpace->code,
            $newCodeNumber
        );
    }

    private function releaseDesk(DeskMangment $desk): void
    {


        if ($desk->user_id) {


            $user = User::findOrFail($desk->user_id);
            $user->update([

                'desk_mangment_id' => null,
                'room_id' => null,

            ]);
        }
        if ($desk->room_id) {
            UserRoom::where('room_id', $desk->room_id)
                ->where('user_id', $desk->user_id)
                ->delete();
        }

        $desk->update([
            'user_id' => null,
            'room_id' => null,
            'status' => 0,
        ]);
    }

    private function updateDeskSubscription(DeskMangment $desk, Request $request): void
    {
        $desk->update([
            'status' => 2,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    private function createInternetSubscription(DeskMangment $desk, Request $request): void {}

    private function successResponse(string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    private function errorResponse(string $message): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ]);
    }
}
