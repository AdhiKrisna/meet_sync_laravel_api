<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => $this->generateUniqueNim(),
            'name' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => ['student', 'lecture'][fake()->numberBetween(0, 1)],
            'phone_number' => fake()->phoneNumber(),
            'profile_picture' => fake()->imageUrl(),
            'remember_token' => Str::random(10),
        ];
    }

    private function generateUniqueNim()
    {
        do {
            $nim = $this->faker->unique()->numerify('#########');
        } while (User::where('nim', $nim)->exists());

        return $nim;
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
