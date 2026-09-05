<?php

namespace App\Services;

use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use Illuminate\Support\Facades\DB;

class SubmissionService
{
    public function __construct(
        private SubmissionRepository $submissionRepository
    ) {}

    public function submit(
        Submission $submission,
        array $answers
    ): Submission {
        return DB::transaction(function () use ($submission, $answers) {
            $submission->load([
                'quiz.questions.options',
            ]);

            $mbtiDimensions = [
                'E' => 0,
                'I' => 0,
                'S' => 0,
                'N' => 0,
                'T' => 0,
                'F' => 0,
                'J' => 0,
                'P' => 0,
            ];
            $score = 0;
            $result = '';

            foreach ($submission->quiz->questions as $question) {
                $optionId = $answers[$question->id] ?? null;

                if ($optionId === null) {
                    continue;
                }

                $option = $question->options
                    ->firstWhere('id', (int) $optionId);

                if ($option === null) {
                    continue;
                }

                $this->submissionRepository->createAnswer(
                    $submission,
                    $question->id,
                    $option->id
                );

                $mbtiDimensions[$option->scoring_key]++;
                $score += $option->score;
            }

            logger('mbti dimension:', $mbtiDimensions);
            $result .= $mbtiDimensions['E'] >= $mbtiDimensions['I'] ? 'E' : 'I';
            $result .= $mbtiDimensions['S'] >= $mbtiDimensions['N'] ? 'S' : 'N';
            $result .= $mbtiDimensions['T'] >= $mbtiDimensions['F'] ? 'T' : 'F';
            $result .= $mbtiDimensions['J'] >= $mbtiDimensions['P'] ? 'J' : 'P';

            return $this->submissionRepository->updateScore(
                $submission,
                $score,
                $result
            );
        });
    }
}
