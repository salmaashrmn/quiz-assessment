<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(
        Request $request,
        Quiz $quiz,
        SubmissionService $submissionService
    ): JsonResponse {
        abort_unless($quiz->status === 'published', 404);

        $validated = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'integer'],
        ]);

        $submission = Submission::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'started_at' => now(),
        ]);

        $submission = $submissionService->submit(
            $submission,
            $validated['answers']
        );

        return response()->json([
            'message' => 'Quiz submitted successfully.',
            'data' => [
                'id' => $submission->id,
                'quiz_id' => $submission->quiz_id,
                'score' => $submission->score,
                'submitted_at' => $submission->submitted_at,
            ],
        ], 201);
    }

    public function show(Submission $submission): JsonResponse
    {
        $submission->load([
            'quiz',
            'answers.question',
            'answers.option',
        ]);

        return response()->json([
            'data' => $submission,
        ]);
    }
}