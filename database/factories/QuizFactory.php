<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Quiz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question_limit' => 7,
            'mark_per_question' => 1,
            'pass_mark' => 5,
            'is_active' => true,
        ];
    }

    public function hasQuestions($count = 1)
    {
        return $this->afterCreating(function (Quiz $quiz) use ($count) {
            Question::factory()->count($count)->create([
                'quiz_id' => $quiz->id
            ]);
        });
    }
}
