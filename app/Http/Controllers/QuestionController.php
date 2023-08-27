<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionCreateRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(Question::with('options')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionCreateRequest $request)
    {
        $question = Question::create($request->validated());

        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return new QuestionResource($question->load('randomOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->validated());

        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response()->noContent();
    }
}
