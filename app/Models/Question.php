<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'text', 'is_active','type'];

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }

    public function randomOptions()
    {
        return $this->hasMany(Option::class, 'question_id', 'id')->inRandomOrder();
    }
}
