<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Question;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'question_limit', 'mark_per_question', 'pass_mark'];
    protected $question_limit = 7;

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->inRandomOrder();
    }

    public function randomQuestions()
    {
        return $this->hasMany(Question::class)->inRandomOrder()->take($this->question_limit)->with('randomOptions');
    }
}
