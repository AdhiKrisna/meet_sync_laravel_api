<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'student_nim',
        'time_start',
        'time_end',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_nim', 'nim');
    }
}
