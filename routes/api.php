<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('quizes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('options', OptionController::class);
Route::apiResource('tests', ExamController::class)->except(['store']);

Route::middleware('throttle:5,1')->post('/tests', [ExamController::class, 'store']);
