<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\JsonResponse;

class QuizController extends Controller
{
    public function __construct(
        private QuizService $quizService
    ) {
    }

    public function index(): JsonResponse
    {
        $quizzes = $this->quizService->getPublishedQuizzes();

        return response()->json([
            'data' => $quizzes,
        ]);
    }

    public function show(Quiz $quiz): JsonResponse
    {
        abort_unless($quiz->status === 'published', 404);

        $quiz->load([
            'questions' => fn ($query) => $query->orderBy('order'),
            'questions.options',
        ]);

        return response()->json([
            'data' => $quiz,
        ]);
    }
}