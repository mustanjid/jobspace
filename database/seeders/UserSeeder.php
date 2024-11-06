<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => "Paul",
            'email' => 'pual@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => fake()->randomElement([1, 0]),
            'remember_token' => 1234,

        ]);
    }
}
