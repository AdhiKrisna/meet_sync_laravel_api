<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meeting;
use App\Models\DetailMeeting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailMeeting::factory(100)->recycle([
            Meeting::all(),
            User::all(),
        ])->create();
    }
}
