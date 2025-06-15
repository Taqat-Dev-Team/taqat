<?php

namespace App\Http\Controllers\Admin\WorkSpaceMangments\WorkSpances;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkSpaces\WorkSpaceRequest;
use App\Models\Branch;
use App\Models\DeskMangment;
use App\Models\Room;
use App\Models\User;
use App\Models\WorkSpace;
use Illuminate\Http\Request;

class WorkSpaceController extends Controller
{
    public function index(Request $request)
    {


        $data['branches'] = Branch::query()->get();



        return view('admin.workSpaceMangements.workSpaces.index', $data);
    }

    public function getIndex(Request $request)
    {
        $accounts = WorkSpace::query()
            ->when(request()->branch_id, function ($q) {
                $q->where('branch_id', request()->branch_id);
            })
            ->orderby('branch_id', 'desc');

        return datatables()->of($accounts)
            ->addColumn('branch_name', function ($account) {
                return $account->branch?->name;
            })
            ->addColumn('free_chairs', function ($account) {
                return $account->deskMangments()->whereNull('user_id')->orwhere('user_id', 0)->count();
            })
            ->addColumn('booked_chairs', function ($account) {
                return $account->deskMangments()->whereNotNull('user_id')->orwhereNot('user_id', 0)->count();
            })
            ->addColumn('free_rooms', function ($account) {
                return $account->rooms()->whereNull('user_id')->orwhere('user_id', 0)->count();
            })
            ->addColumn('booked_rooms', function ($account) {
                return $account->rooms()->where('user_id')->orwhereNot('user_id', 0)->count();
            })
            ->addColumn('room_count', function ($data) {
                return '<a href="' . route('admin.workSpaceManagments.rooms.index', ['work_space_id' => $data->id, 'branch_id' => $data->branch_id]) . '">' . $data->rooms()->count() . '</a>';
            })
            ->addColumn('desk_count', function ($data) {
                return '<a href="' . route('admin.workSpaceManagments.deskManagments.index', ['work_space_id' => $data->id, 'branch_id' => $data->branch_id]) . '">' . $data->deskMangments()->count() . '</a>';
            })

            ->addColumn('branch_name', function ($data) {
                return $data->branch?->name;
            })
            ->addColumn('action', function ($data) {
                return view('admin.workSpaceMangements.workSpaces.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'room_count', 'desk_count'])
            ->make(true);
        return datatables()->of($accounts)->make(true);
    }


    public function store(WorkSpaceRequest $request)
    {
        $branch = Branch::query()->where('id', $request->branch_id)->first();

        $workSpace = WorkSpace::create([
            'name' => $request->name,
            'code' => $request->code,
            'branch_id' => $request->branch_id,
            'room_count' => $request->room_count,
            'desk_count' => $request->desk_count,
        ]);


        for ($i = 1; $i <= $request->room_count; $i++) {



            $code = $branch->code . '-' . $request->code . '-' . 'R' . str_pad($i, 3, '0', STR_PAD_LEFT);
            Room::query()->create([
                'code' => $code,
                'work_space_id' => $workSpace->id,
                'branch_id' => $workSpace->branch_id,

            ]);
        }


        for ($i = 1; $i <= $request->desk_count; $i++) {

            $code =  $branch->code . '-' . $request->code . '-' . 'T' . str_pad($i, 3, '0', STR_PAD_LEFT);
            DeskMangment::query()->create([
                'code' => $code,
                'internet_code' => rand(1, 9999999),
                'work_space_id' => $workSpace->id,
                'branch_id' => $workSpace->branch_id,
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(WorkSpaceRequest $request)
    {


        $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();


        // إنشاء الحساب الجديد
        $workSpace->update([
            'name' => $request->name,
            'code' => $request->code,
            'branch_id' => $request->branch_id,

        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        $workSpace =  WorkSpace::query()->where('id', $request->id)->first();

        $rooms = Room::query()->where('work_space_id', $workSpace->id)->get();

        foreach ($rooms as $room) {

            if ($room->user_id) {
                User::query()->where('id', $room->user_id)->update([
                    'room_id' => null,
                    'work_space_type' => null,
                    'work_space_id' => null,

                ]);
            }
            $room->delete();
        }


        $desk_mangments = DeskMangment::query()->where('work_space_id', $workSpace->id)->get();
        foreach ($desk_mangments as $desk_mangment) {


            if ($desk_mangment->user_id) {
                User::query()->where('id', $room->user_id)->update([
                    'desk_mangment_id' => null,
                    'work_space_type' => null,
                    'work_space_id' => null,

                ]);
            }
            $desk_mangment->delete();
        }

        $workSpace->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function AddDeskMangment(WorkSpaceRequest $request)
    {
        $branch = Branch::query()->where('id', $request->branch_id)->first();

        $workSpace = WorkSpace::query()->find( $request->work_space_id);


        for ($i = 1; $i <= $request->room_count; $i++) {
            $lastRoom = Room::query()->orderBy('id', 'desc')
                ->where('work_space_id', $request->work_space_id)
                ->first();
            $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();

            $lastCode = $lastRoom ? $lastRoom->code : $workSpace->code . '-T000';
            $lastCodeParts = explode('-', $lastCode);
            $lastCodeNumber = (int)substr(end($lastCodeParts), 1);
            $newCodeNumber = $lastCodeNumber + 1;
            $branch = $workSpace?->branch;
            $newCode = $branch?->code . '-' . $workSpace->code . '-R' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);

            Room::query()->create([
                'code' => $newCode,
                'work_space_id' => $workSpace->id,
                'branch_id' => $workSpace->branch_id,

            ]);
        }


        for ($i = 1; $i <= $request->desk_count; $i++) {

            $lastDesk = DeskMangment::query()->orderBy('id', 'desc')
                ->whereNull('room_id')
                ->where('work_space_id', $request->work_space_id)
                ->first();
            $workSpace = WorkSpace::query()->where('id', $request->work_space_id)->first();
            $lastCode = $lastDesk ? $lastDesk->code : $workSpace->code . '-T000';
            $lastCodeParts = explode('-', $lastCode);
            $lastCodeNumber = (int)substr(end($lastCodeParts), 1);
            $newCodeNumber = $lastCodeNumber + 1;
            $branch = $workSpace?->branch;
            $newCode = $branch?->code . '-' . $workSpace->code . '-T' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);

            DeskMangment::query()->create([
                'code' => $newCode,
                'internet_code' => rand(1, 9999999),
                'work_space_id' => $workSpace->id,
                'branch_id' => $workSpace->branch_id,
            ]);



        }

        $workSpace->update([
            'room_count' => $workSpace->rooms()->count(),
            'desk_count' => $workSpace->deskMangments()->count(),

        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
