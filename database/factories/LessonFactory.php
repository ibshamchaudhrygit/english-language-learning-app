<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, 'education'),
            'video_url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9]{11}'),
            'price' => fake()->randomElement(['Free','10 USD','20 USD']),
            'duration' => fake()->randomElement(['2 weeks','4 weeks','6 weeks']),
            'enrollments' => fake()->numberBetween(50, 500),
            'user_id' => \App\Models\User::factory()->state(fn() => ['role' => 'teacher']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
