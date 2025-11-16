<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = [
            fake()->word(),
            fake()->word(),
            fake()->word(),
            fake()->word()
        ];
        $correct_index = fake()->numberBetween(0,3);
        $correct_option = ['option_a','option_b','option_c','option_d'][$correct_index];

        return [
            'quiz_id' => \App\Models\Quiz::factory(),
            'title' => fake()->sentence(),
            'option_a' => $options[0],
            'option_b' => $options[1],
            'option_c' => $options[2],
            'option_d' => $options[3],
            'correct_answer' => $correct_option,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
