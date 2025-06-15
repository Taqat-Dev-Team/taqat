<?php

namespace App\Http\Controllers\Admin\WorkSpaceMangments\RoomMangments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkSpaceMangments\RoomMangments\RoomMangmentsRequest;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\DeskMangment;
use App\Models\Room;
use App\Models\RoomHistory;
use App\Models\SubscriptionInternet;
use App\Models\SubscriptionType;
use App\Models\User;
use App\Models\UserRoom;
use App\Models\WorkSpace;
use Illuminate\Http\Request;

class RoomMangmentsController extends Controller
{
    public function index(Request $request)
    {
        $data['workSpaces'] = WorkSpace::query()->get();
        $data['branches'] = Branch::query()->get();
        $data['users'] = User::query()->where('status', 1)->get();
        $data['work_space_id'] = null;
        $data['branch_id'] = null;
        $data['subscriptionTypes'] = SubscriptionType::query()->get();
        $data['currencies'] = Constant::query()->where('key','currency')->whereNotNull('parent_id')->get();

        if ($request->work_space_id) {
            $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();
            $data['work_space_id'] = $workSpace?->id;
            $data['branch_id'] = $workSpace?->branch_id;
        }

        return view('admin.workSpaceMangements.rooms.index', $data);
    }

    public function getIndex(Request $request)
    {
        $query = Room::query()
            ->when(request()->work_space_id, function ($q) {
                $q->where('work_space_id', request()->work_space_id);
            })
            ->when(request()->branch_id, function ($q) {
                $q->where('branch_id', request()->branch_id);
            })
            ->orderby('branch_id', 'desc');

        return datatables()->of($query)
            ->addColumn('work_space_name', function ($data) {
                return $data->workSpaces?->name;
            })
            ->addColumn('branch_name', function ($data) {
                return $data->branches?->name;
            })
            ->addColumn('user_name', function ($data) {
                return $data->users?->name;
            })
            ->addColumn('user_count', function ($data) {

                $userIds = json_encode($data->userRooms()->pluck('user_id')->toArray());

                return '<a href="#" class="nav-link users"
                            data-room_id="' . $data->id . '"
                            data-work_space_id="' . $data->work_space_id . '"
                            data-user_ids=\'' . $userIds . '\'
                            title="مستخدمين الغرفة">'
                            . $data->userRooms()->count() .
                       '</a>';

            })




            ->addColumn('action', function ($data) {

                return view('admin.workSpaceMangements.rooms.partials.actions', compact('data'));
                // return $button;
            })
            ->rawColumns(['action','user_count'])
            ->make(true);
        return datatables()->of($accounts)->make(true);
    }


    public function store(RoomMangmentsRequest $request)
    {

        $workSpaces = WorkSpace::query()->find($request->work_space_id);

        $room =  Room::create([
            'code' => $request->code,
            'work_space_id' => $request->work_space_id,
            'user_id' => $request->user_id,
            'branch_id' => $workSpaces->branch_id,
            'capacity' => $request->capacity,
            'subscription_type_id' => $request->subscription_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'attendance_status' => $request->attendance_status,
            'amount' => $request->amount,


        ]);


        if ($request->user_id) {


            User::query()->where('id', $request->user_id)->update([
                'room_id' => $room->id,
                'work_space_type' => 2,
                'work_space_id' => $workSpaces->id

            ]);

            if ($request->attendance_status == 1) {

                UserRoom::query()->create([
                    'user_id' => $request->user_id,
                    'subscription_type_id' => $request->subscription_type_id,
                    'room_id' => $room->id,
                ]);
            }
        }
        $workSpaces->update([
            'room_count' => $workSpaces->rooms()->count(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function update(RoomMangmentsRequest $request)
    {
        // Retrieve the room and workspaces
        $room = Room::findOrFail($request->room_id);
        $WorkSpace = WorkSpace::findOrFail($room->work_space_id);
        // $oldWorkSpace = WorkSpace::find($room->work_space_id);

        // Track the old user assigned to the room
        $oldUserRoom = $room->user_id;
        $currentDesks = DeskMangment::where('room_id', $room->id)->get();
        $currentCount = $currentDesks->count();

        // لا تقم بأي شيء إذا كانت السعة المطلوبة تساوي عدد الكراسي الموجود

        // تقليل السعة
        if ($request->capacity < $currentCount) {
            $desksToRemove = $currentDesks->slice($request->capacity);
            $hasOccupied = $desksToRemove->contains(function ($desk) {
                return $desk->user_id !== null;
            });

            if ($hasOccupied) {
                return response()->json(['message' => 'لا يمكن تقليص مساحة العمل لأن بعض الكراسي مستخدمة'], 422);
            }

            DeskMangment::whereIn('id', $desksToRemove->pluck('id'))->delete();
        }

        // زيادة السعة
        elseif ($request->capacity > $currentCount) {
            $workSpace = WorkSpace::find($room->work_space_id);
            if (!$workSpace) {
                return response()->json(['message' => 'المساحة غير موجودة'], 404);
            }
            $branch = $workSpace->branch;

            $desksToAdd = $request->capacity - $currentCount; // ✅ الفرق فقط

            for ($i = 1; $i <= $desksToAdd; $i++) {
                $lastDesk = DeskMangment::where('work_space_id', $room->work_space_id)->orderBy('id', 'desc')->first();
                $lastCode = $lastDesk?->code;
                $lastCodeNumber = 0;

                if ($lastCode) {
                    $parts = explode('-', $lastCode);
                    $lastCodeNumber = isset($parts[3]) ? (int)substr($parts[3], 1) : 0;
                }

                $newCodeNumber = $lastCodeNumber + 1;
                $newCode = $branch?->code . '-' . $workSpace->code . '-R00' . ($currentCount + $i) . '-T' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);

                DeskMangment::create([
                    'room_id' => $room->id,
                    'code' => $newCode,
                    'work_space_id' => $room->work_space_id,
                    'internet_code' => rand(1, 9999999),
                    'branch_id' => $workSpace->branch_id,
                    'subscription_type_id' => $request->subscription_type_id,
                    'start_date' => $room->start_date,
                    'end_date' => $room->end_date,
                ]);
            }
        }

        // تحديث السعة النهائية بعد التعديلات




        // Update the room details
        $room->update([
            'work_space_id' => $room->work_space_id,
            'user_id' => $request->user_id,
            'branch_id' => $WorkSpace->branch_id,
            'capacity' => $request->capacity,
            'subscription_type_id' => $request->subscription_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'attendance_status' => $request->attendance_status,
            'amount' => $request->amount,
        ]);

        if ($request->user_id) {
            User::where('id', $request->user_id)->update([
                'room_id' => $room->id,
                'work_space_type' => 2,
                'work_space_id' => $room->work_space_id,
            ]);

            // Create a new UserRoom record if the user is different from the old user
            if ($oldUserRoom != $request->user_id) {


                if ($request->attendance_status == 1) {

                    UserRoom::create([
                        'user_id' => $request->user_id,
                        'subscription_type_id' => $request->subscription_type_id,
                        'room_id' => $room->id,

                    ]);
                }
                // Update the end_date of the previous RoomHistory record for the user


                $last_room = RoomHistory::query()->where('room_id', $room->id)->orderby('id', 'desc')->first();

                if ($last_room) {
                    $last_room->update([
                        'end_date' => now()
                    ]);
                }
                // Create a new RoomHistory record for the user
                RoomHistory::query()->create([
                    'user_id' => $request->user_id,
                    'room_id' => $room->id,
                    'start_date' => now(),
                ]);
            }

            // Clear the old user's room assignments if necessary
            if ($oldUserRoom && $oldUserRoom != $request->user_id) {
                User::where('id', $oldUserRoom)->update([
                    'room_id' => null,
                    'work_space_type' => null,
                    'work_space_id' => null,
                ]);
            }
        }





        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }



    public function delete(Request $request)
    {

        $room = Room::query()->where('id', $request->id)->first();
        $workSpace = WorkSpace::find($room->work_space_id);
        $room->delete();
        if ($workSpace) {
            $workSpace->update([
                'room_count' => $workSpace->rooms()->count(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('label.delete_elemnet_success_full'),
        ]);
    }


    public function getCode(Request $request)
    {
        $lastRoom = Room::query()->orderBy('id', 'desc')
            ->where('work_space_id', $request->work_space_id)
            ->first();
        $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();
        $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();

        $lastCode = $lastRoom ? $lastRoom->code : $workSpace->code . '-T000';
        $lastCodeParts = explode('-', $lastCode);
        $lastCodeNumber = (int)substr(end($lastCodeParts), 1);
        $newCodeNumber = $lastCodeNumber + 1;
        $branch = $workSpace?->branch;
        $newCode = $branch?->code . '-' . $workSpace->code . '-R' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);

        return response()->json([
            'success' => true,
            'new_code' => $newCode,
        ]);
    }
    public function getWorkSpaces(Request $request)
    {
        $workSpaces = WorkSpace::query()->where('branch_id', $request->branch_id)->get();
        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
        ]);
    }
    public function getUsers(Request $request)
    {
        $room_id=$request->room_id;
        $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();
        $users = User::where('branch_id', $workSpace->branch_id)
        // ->where(function ($query) use ($room_id) {
        //     $query->whereDoesntHave('deskMangment') // المستخدمين الذين ليس لديهم كراسي
        //         ->orWhereHas('deskMangment', function ($query) use ($room_id) {
        //             $query->where('room_id', $room_id); // المستخدمين الذين لديهم كراسي في نفس الغرفة
        //         });
        // })
        ->get();
        return response()->json(['users' => $users]);
    }

    public function release(Request $request)
    {

        Room::query()->where('id', $request->room_id)->update([
            'user_id' => null
        ]);

        DeskMangment::query()->where('room_id', $request->room_id)->update([
            'user_id' => null,
            'start_date' => null,
            'end_date' => null,
            // 'subscription_type_id' => null,
        ]);
        UserRoom::query()->where('room_id', $request->room_id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function postUsers(Request $request)
    {
        // Clear all desks in the room
        DeskMangment::where('room_id', $request->room_id)->update(['user_id' => null]);

        // Delete all UserRoom records associated with the room
        UserRoom::where('room_id', $request->room_id)->delete();

        $userIds = array_unique($request->user_ids); // Remove duplicates if any

        // Fetch empty desks in the room
        $emptyDesks = DeskMangment::where('room_id', $request->room_id)
            ->whereNull('user_id')
            ->pluck('id')
            ->toArray();

        $deskCount = count($emptyDesks);

        if ($deskCount < count($userIds)) {
            return response()->json([
                'success' => false,
                'message' => __('label.desk_mangment_limit_users'),
            ]);
        }

        // Assign users to desks
        $assignments = array_combine(
            array_slice($emptyDesks, 0, count($userIds)), // Select desks matching the number of users
            $userIds // Users to be assigned
        );

        foreach ($assignments as $deskId => $userId) {
            $desk_mangments = DeskMangment::find($deskId);
            if ($desk_mangments) {
                $desk_mangments->update(['user_id' => $userId]);

                // Create a new UserRoom record for the user
                UserRoom::create([
                    'user_id' => $userId,
                    'room_id' => $request->room_id,
                    'subscription_type_id' => 1,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function getRoomHistories(Request $request)
    {
        $histories = RoomHistory::query()
            ->with('users')
            ->where('room_id', $request->room_id)
            ->select('user_id', 'start_date', 'end_date') // إرجاع user_id بدلاً من manager
            ->get();




        return response()->json([
            'success' => true,
            'histories' => $histories
        ]);
    }


    public function subscriptionInternet(Request $request)
    {



        $desk_mangments = DeskMangment::query()->where('room_id', $request->room_id)
            ->get();

        $room = Room::query()->where('id', $request->room_id)->update([
            'end_date' => $request->end_date,
            'start_date' => $request->start_date
        ]);

        foreach ($desk_mangments as $value) {
            $value->update([
                'status' => 2,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,

            ]);
            $user = User::query()->find($request->user_id);
            $subscriptionInternet = SubscriptionInternet::where('user_id', $request->user_id)->first();

            SubscriptionInternet::query()->updateOrCreate([
                'user_id' => $value->user_id,
            ], [
                'desk_mangment_id' => $value->id,
                'subscription_type_id' => $value->subscription_type_id,
                'internet_code' => $value->internet_code,
                'internet_password' => rand(1000, 9999),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'new_account' => $subscriptionInternet ? 0 : 1,
                'status' => 2,

            ]);
        }


        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public function AddRooms(Request $request)
    {
        $room = Room::query()->find($request->room_id);
        for ($i = 1; $i <= $request->capacity; $i++) {
            $lastDesk = DeskMangment::query()
                ->where('work_space_id', $room->work_space_id)
                ->orderBy('id', 'desc')
                ->first();

            $workSpace = WorkSpace::query()->where('id', $room->work_space_id)->first();

            if (!$workSpace) {
                continue; // Skip iteration if workspace is null
            }

            $branch = $workSpace->branch;
            $lastCode = $lastDesk ? $lastDesk->code : null;

            if ($lastCode) {
                $lastCodeParts = explode('-', $lastCode);
                $lastCodeNumber = isset($lastCodeParts[2]) ? (int)substr($lastCodeParts[2], 1) : 0;
                $newCodeNumber = $lastCodeNumber + 1;
            } else {
                $newCodeNumber = 1;
            }


            $newCode = $branch?->code . '-' . $workSpace->code . 'R-00' . $i . '-T' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);
            DeskMangment::query()->create([
                'room_id' => $request->room_id,
                'code' => $newCode,
                'work_space_id' => $room->work_space_id,
                'internet_code' => rand(1, 9999999),
                'branch_id' => $workSpace->branch_id,
                'subscription_type_id' => $room->subscription_type_id,
                'start_date' => $room->start_date,
                'end_date' => $room->end_date,
            ]);



        }

        $room->update([
            'capacity' => $room->deskMangments()->count(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
}
