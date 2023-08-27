<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'participent_name', 'participent_age',
        'participent_gender', 'participent_fingerprint', 'answers', 'is_retake',
        'ip','user_agent'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($exam) {
            $exam->result = $exam->calculateResult();
        });
    }

    public function calculateResult(): float
    {
        // Perform your calculation logic here
        // For example, calculate and return a value
        // You can access other attributes using $this->attributeName
        $answers = json_decode($this->answers);

        $quiz = Quiz::find($this->quiz_id);

        $limit = $quiz->question_limit;

        $result = 0;

        foreach ($answers as $question_id => $answer_id) {

            if (!$limit) break; // break if quiz questions limit exceeded

            $question = Question::where([
                'quiz_id' => $quiz->id,
                'id' => $question_id
            ])->with('options')->first();

            foreach ($question->options as $option) {
                if ($option->id == $answer_id && $option->is_correct) {
                    //calculate the mark
                    $result += $quiz->mark_per_question;
                    break;
                }
            }

            $limit--;
        }

        return $result;
    }
}
