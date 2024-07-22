<?php

namespace Database\Seeders;

use App\Models\DetailMeeting;
use App\Models\User;
use App\Models\Lecture;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Meeting;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
        ]);
        $this->call([
            MeetingSeeder::class,
        ]);
        $this->call([
            DetailMeetingSeeder::class,
        ]);
    }
}
