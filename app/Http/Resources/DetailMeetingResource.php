<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailMeetingResource extends JsonResource
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
            'meeting_id' => $this->meeting_id,
            'meeting_title' => $this->meeting ? $this->meeting->title : null, 
            'meeting_description' => $this->meeting ? $this->meeting->description : null,
            'meeting_date' => $this->meeting ? $this->meeting->date : null,
            'meeting_place' => $this->meeting ? $this->meeting->place : null,
            'lecture' => $this->meeting ? $this->meeting->lecture->name : null,
            'student_nim' => $this->student_nim,
            'student' => $this->student ? $this->student->name : null,
            'duration' => $this->meeting ? $this->meeting->duration : null,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ];
    }
}
