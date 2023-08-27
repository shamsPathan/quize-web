<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'quiz_id' => 'required| integer | exists:quizzes,id',
            'participent_name' => 'required| string',
            'participent_age' => 'required| string',
            'participent_gender' => 'required| string',
            'participent_fingerprint' => 'nullable| string',
            'answers' => 'nullable| json',
            'is_retake' => 'nullable| boolean',
        ];
    }

    public function validatedAndUserInfo()
    {
        return array_merge(
            $this->validated(),
            [
                'user_agent' => request()->userAgent(),
                'ip'         => request()->getClientIp()
            ]
        );
    }
}
