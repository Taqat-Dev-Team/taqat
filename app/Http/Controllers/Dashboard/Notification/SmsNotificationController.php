<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use App\Services\SMSService;
use Illuminate\Http\Request;

class SmsNotificationController extends Controller
{

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }


    public function create(){

        $data['branches']=Branch::query()->get();
        return view('admin.notifications.create',$data);
    }
    public function store(Request $request)
    {
        $branch_id = $request->type == 2 ? $request->branch_id : null;
        $user_id = $request->type == 3 ? $request->user_id : null;
        $message = $request->message;

        // Retrieve users based on branch_id or user_id
        $users = User::query()
            ->when($user_id, function ($q) use ($user_id) {
                $q->whereIn('id', $user_id);
            })
            ->when($branch_id, function ($q) use ($branch_id) {
                $q->whereIn('branch_id', $branch_id);
            })
            ->get();

        foreach ($users as $user) {
             $this->smsService->sendSMS($user->mobile, $message);
        }

        // Return success response
        $response['data']=[];
        return response_web(true, 'تم تنفيد العملية بنجاح', $response, 201);
    }



    public function getUsers(Request $request)
{
    $search = $request->input('search', '');

    // Adjust query to include search functionality
    $users = User::query()
        ->select('id', 'name')
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->get();

    return response()->json($users);
}
}
