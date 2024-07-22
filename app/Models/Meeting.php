<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'title',
        'description',
        'date', 
        'place',
        'time_start',
        'time_end',
        'duration',
        'lecture_nim',
    ];

    public function lecture()
    {
        return $this->belongsTo(User::class, 'lecture_nim', 'nim');
    }

    public function detailMeetings()
    {
        return $this->hasMany(DetailMeeting::class);
    }
}
