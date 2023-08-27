<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required| string',
            'question_limit' => 'nullable| integer',
            'mark_per_question' => 'nullable| integer',
            'pass_mark' => 'nullable| integer',
            'is_active' => 'nullable| boolean',
        ];
    }
}
