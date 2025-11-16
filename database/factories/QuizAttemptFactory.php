<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizAttempt>
 */
class QuizAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $score = fake()->numberBetween(0, 100);

        return [
            'quiz_id' => \App\Models\Quiz::factory(),
            'user_id' => \App\Models\User::factory()->state(fn() => ['role' => 'user']),
            'score' => $score,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
