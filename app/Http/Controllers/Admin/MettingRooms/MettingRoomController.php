<?php

namespace App\Http\Controllers\Admin\MettingRooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MettingRooms\MettingRoomRequest;
use App\Models\MeetingRoom;
use Illuminate\Http\Request;

class MettingRoomController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.mettingRrooms.index');
    }

    public function getIndex(Request $request)
    {
        $meetingRoom = MeetingRoom::query()
            ->orderby('id', 'desc');
        return datatables()->of($meetingRoom)
            ->addColumn('action', function ($data) {
                return view('admin.mettingRrooms.partials.actions', compact('data'));
            })


            ->rawColumns(['action'])
            ->make(true);
    }


    public function store(MettingRoomRequest $request)
    {

        MeetingRoom::create([
            'name' => $request->name,
            'duration'=>$request->duration,
            'branch_id' => $request->branch_id
        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {


        $meetingRoom = MeetingRoom::query()->where('id', $request->meeting_room_id)->first();
        $meetingRoom->update([
            'name' => $request->name,
            'duration'=>$request->duration,
            'branch_id' => $request->branch_id
        ]);
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        MeetingRoom::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
