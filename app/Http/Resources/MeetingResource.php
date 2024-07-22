<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'place' => $this->place,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'duration' => $this->duration,
            'lecture_nim' => $this->lecture_nim,
            'lecture_name' => $this->lecture ? $this->lecture->name : null,
            // 'list_detail' => DetailMeetingResource::collection($this->detailMeetings)
            'list_detail' => $this->detailMeetings->map(function ($detailMeeting) {
                return [
                    'id' => $detailMeeting->id,
                    'student_nim' => $detailMeeting->student_nim,
                    'student_name' => $detailMeeting->student ? $detailMeeting->student->name : null,
                    'time_start' => $detailMeeting->time_start,
                    'time_end' => $detailMeeting->time_end,
                ];
            }),
        ];
    }
}
