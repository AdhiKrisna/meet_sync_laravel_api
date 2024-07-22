<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'date' => fake()->dateTime(),
            'place' => fake()->address(),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'duration' => fake()->numberBetween(1, 60),
            'lecture_nim' => User::where('role', 'lecture')->inRandomOrder()->first()->nim,
        ];
    }
}
