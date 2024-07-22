<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DetailMeeting;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailMeetingResource;

class DetailMeetingController extends Controller
{
    public function available()
    {
        $availableMeeting = DetailMeeting::where('student_nim', null)->get();
        return DetailMeetingResource::collection($availableMeeting, 200);
    }

    public function meetingDetail($id)
    {
        $detailedMeeting = DetailMeeting::with(['meeting'])->findOrFail($id);
        if ($detailedMeeting) {
            return new DetailMeetingResource($detailedMeeting,200); //new karena single data
        } else {
            return response()->json(['message' => 'Meeting not found'], 404);
        }
    }

    public function registerMeeting($id, Request $request)
    {
        $detailMeeting = DetailMeeting::where('id', $id)->where('student_nim', null)->first();
        if ($detailMeeting) {
            $detailMeeting->update([
                'student_nim' => $request->user()->nim,
            ]);
            return new DetailMeetingResource($detailMeeting, 200);
        } else {
            return response()->json(['message' => 'Meeting is full'], 400);
        }
    }

    public function deleteMeeting($id, Request $request)
    {
        $detailMeeting = DetailMeeting::where('id', $id)->where('student_nim', $request->user()->nim)->first();
        if ($detailMeeting) {
            $detailMeeting->update([
                'student_nim' => null,
            ]);
            return new DetailMeetingResource($detailMeeting, 200);
        } else {
            return response()->json(['message' => 'Meeting not found'], 404);
        }
    }

    public function searchByLecturerName(Request $request)
    {
        $request->validate([
            'lecturer_name' => 'required|string'
        ]);

        $lecturerName = $request->lecturer_name;

        $meetings = DetailMeeting::with('meeting.lecture')
            ->whereNull('student_nim')
            ->whereHas('meeting.lecture', function ($query) use ($lecturerName) {
                $query->where('name', 'LIKE', "%{$lecturerName}%");
            })->get();

        if ($meetings->isEmpty()) {
            return response()->json(['message' => 'No meetings found'], 404);
        }

        return response()->json(DetailMeetingResource::collection($meetings), 200);
    }

}
