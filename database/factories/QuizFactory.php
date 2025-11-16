<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => \App\Models\Lesson::factory(),
            'title' => fake()->sentence(3),
            'user_id' => \App\Models\User::factory()->state(fn() => ['role' => 'teacher']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
