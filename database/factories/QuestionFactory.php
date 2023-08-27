<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\Option;

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
        return [
            'quiz_id' => 7,
            'type' => 'multiple_choice',
            'text' => substr(str_replace('.', '', fake()->sentence(5)), 0, 25) . " ?",
            'is_active' => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Question $question) {

            $options = Option::factory()->count(4)->make(); // Create 4 options in-memory

            foreach ($options as $index => $option) {
                $option->question_id = $question->id;
                $option->is_correct = ($index === $question->id % 4) ? 1 : 0;
                $option->save();
            }
        });
    }
}
