<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\SubmissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/quizzes', [QuizController::class, 'index']);

Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])
    ->name('api.quizzes.show');

Route::post('/quizzes/{quiz}/submissions', [SubmissionController::class, 'store'])
    ->name('api.submissions.store');

Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])
    ->name('api.submissions.show');
