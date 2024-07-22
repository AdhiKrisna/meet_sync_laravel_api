<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetingRequest;
use App\Http\Resources\DetailMeetingResource;
use App\Http\Resources\MeetingResource;
use App\Models\DetailMeeting;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function allMeeting()
    {
        $meetings = Meeting::all();
        return MeetingResource::collection($meetings, 200); //collection karena banyak data
    }

    public function search($id)
    {
        $meeting = Meeting::with(['lecture'])->findOrFail($id);
        if ($meeting) {
            return new MeetingResource($meeting, 200); //new karena single data
        } else {
            return response()->json(['message' => 'Meeting not found'], 404);
        }
    }

    //post method
    public function store(CreateMeetingRequest $request)
    {
        $request->validated();
        $meetingData = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'place' => $request->place,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'duration' => $request->duration,
            'lecture_nim' => $request->user()->nim,
        ];

        $meeting = Meeting::create($meetingData);

        $duration = $request->duration * 60;
        $time_start = strtotime($request->time_start);
        $time_end = strtotime($request->time_end);
        $meetingDuration = ($time_end - $time_start);
        $amountDetailedMeeting = $meetingDuration / $duration;
        for ($i = 0; $i < $amountDetailedMeeting; $i++) {
            $detailStart = $time_start + ($i * $duration);
            $detailEnd = $detailStart + $duration;
            if ($detailEnd > $time_end) {
                break;
            }
            $detailMeeting = [
                'meeting_id' => $meeting->id,
                'student_nim' => null,
                'time_start' => date('H:i', $detailStart),
                'time_end' => date('H:i', $detailEnd),
            ];
            $listDetailMeeting[] = $detailMeeting;
            DetailMeeting::create($detailMeeting);
        }
        return new MeetingResource($meeting, 201);
    }
}
