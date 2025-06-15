<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Services\ZoomService;
use App\Traits\UseZoom;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;

class MeetController extends Controller
{
    protected $zoom;


    use UseZoom;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;


    public function createZoomLink($request)
    {

        $data = $this->create($request);

        return $data;
    }
    public function updateZoomLink($id, $data)
    {
        $data = $this->updatezoom($id, $data);
        return $data;
        // $path = 'meetings/' . $id;
        // $url = $this->retrieveZoomUrl();

        // $body = [
        //     'headers' => $this->headers,
        //     'body'    => json_encode([
        //         'topic'      => $data['topic'],
        //         'type'       => self::MEETING_TYPE_SCHEDULE,
        //         'start_time' => $this->toZoomTimeFormat($data['start_time']),
        //         'duration'   => $data['duration'],
        //         'agenda'     => (!empty($data['agenda'])) ? $data['agenda'] : null,
        //         'timezone'     => 'Africa/Cairo',

        //     ]),
        // ];
        // $response =  $this->client->patch($url . $path, $body);

        // return [
        //     'success' => $response->getStatusCode() === 204,
        //     'data'    => json_decode($response->getBody(), true),
        // ];
    }
    public function deleteZoomLink($request)
    {

        $data = $this->delete($request);
        // $meeting = $this->createMeeting($request);
        // $x = [
        //     'join_url' => $meeting->join_url,
        //     'id' => $meeting->id,
        //     'user_id' => $meeting->user_id
        // ];
        // $data['meeting'] = $x;
        // return response()->json($data);
        return $data;
    }


    public function linkZoomAccount(Request $req)
    {
           $response = $this->linkZoom(Auth::Id(), $req->email);
           return back()->with('message', $response['message']);


    }

    public function createMeeting (Request $request)
    {
        $meetings = Zoom::createMeeting([
            "agenda" => 'your agenda',
            "topic" => 'your topic',
            "type" => 2, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => 60, // in minutes
            "timezone" => 'Asia/Dhaka', // set your timezone
            "password" => 'set your password',
            "start_time" => 'set your start time', // set your start time
            "template_id" => 'set your template id', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            "schedule_for" => 'set your schedule for profile email ', // set your schedule for
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);

        return $meetings;
    }
    public function meeting(Request $req)
    {

        return view('zoom.meeting', get_defined_vars());
    }

     /**
     * Zoom ended
     *
     * @return \Illuminate\Http\Response
     */
    public function ended(Request $req)
    {
        return view('zoom.class-end');
    }
}
