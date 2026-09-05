<?php

namespace App\Repositories;

use App\Models\Submission;
use App\Models\SubmissionAnswer;

class SubmissionRepository
{
    public function createAnswer(
        Submission $submission,
        int $questionId,
        int $optionId
    ): SubmissionAnswer {
        return $submission->answers()->create([
            'question_id' => $questionId,
            'option_id' => $optionId,
        ]);
    }

    public function updateScore(
        Submission $submission,
        int $score,
        String $result
    ): Submission {
        $submission->update([
            'score' => $score,
            'result' => $result,
            'submitted_at' => now(),
        ]);

        return $submission->refresh();
    }
}
