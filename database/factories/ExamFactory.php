<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'VICTVS' . fake()->randomDigit(),
            'description' => 'VICTVS Exam ' . fake()->randomDigit(),
            'candidate_id' => fake()->randomDigitNotZero(User::pluck('id')),
            'candidate_name' => fake()->randomElement(User::pluck('name')),
            'location_name' => fake()->city(),
            'date' => fake()->dateTimeBetween('+0 days', '+4 years'),
            'longitude' => fake()->unique()->randomFloat(7, 0.0100000, 500.000000000),
            'latitude' => fake()->unique()->randomFloat(7, 0.0100000, 500.000000000),
        ];
    }
}
