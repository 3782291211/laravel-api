<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Exam;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        User::factory()
            ->count(21)
            ->has(
                Exam::factory()
                        ->count(fake()->numberBetween(2, 22))
                        ->state(fn (array $attributes, User $user) => 
                            [
                                'candidate_id' => $user->id,
                                'candidate_name' => $user->name
                            ]
                        )
            )
            ->create();
    }
}