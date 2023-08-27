<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExamResource::collection(Exam::orderBy('id', "DESC")->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $exam = Exam::create($request->validatedAndUserInfo());

        return new ExamResource($exam);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $test)
    {
        return new ExamResource($test);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, Exam $test)
    {
        $test->update($request->validated());

        return new ExamResource($test);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $test)
    {
        $test->delete();

        return response()->noContent();
    }
}
