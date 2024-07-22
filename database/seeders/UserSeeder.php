<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'nim' => '123456789',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'lecture',
            'profile_picture' => fake()->imageUrl(),    
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'nim' => '123220038',
            'name' => 'Adhi Krisna',
            'email' => 'krisnahmbtn@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'student',
            'profile_picture' => fake()->imageUrl(),    
            'remember_token' => Str::random(10),
        ]);
        User::factory(20)->create();
    }
}
