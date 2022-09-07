<?php

namespace App\Http\Traits;

use MacsiDigital\Zoom\Facades\Zoom;

trait ZoomMeeting
{

    public function createMeeting($request)
    {
        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'start_time' => $request->start_time,
            'time_zone' => config('zoom.timezone'),
        ];

        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings->make([
            'join_before_host' => true,
            'approval_type' => 1,
        ]);

        return $user->meetings()->save($meeting);
    }

    public function deleteMeeting($meeting_id)
    {
        $meeting = Zoom::meeting()->find($meeting_id);
        $meeting->delete();
    }
}


