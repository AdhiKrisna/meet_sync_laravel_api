<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailMeeting>
 */
class DetailMeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meeting_id' => Meeting::factory(),
            'student_nim' => User::where('role', 'student')->inRandomOrder()->first()->nim,
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
        ];
    }
}
