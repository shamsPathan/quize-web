<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Resources\QuizResource;
use App\Http\Requests\QuizRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return QuizResource::collection(
        //     Quiz::active()->get()->map(function ($quiz) {
        //         $quiz->setRelation('questions', $quiz->questions->take($quiz->question_limit));
        //         return $quiz;
        //     })
        // );

        return QuizResource::collection(Quiz::active()->withCount('questions')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizRequest $request)
    {
        $quiz = Quiz::create($request->validated());

        return new QuizResource($quiz);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quize)
    {
        return new QuizResource($quize->load('randomQuestions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizRequest $request, Quiz $quize)
    {
        $quize->update($request->validated());

        return new QuizResource($quize);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quize)
    {
        $quize->delete();

        return response()->noContent();
    }
}
