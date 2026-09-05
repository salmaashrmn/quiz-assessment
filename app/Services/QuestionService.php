<?php

namespace App\Services;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Collection;

class QuestionService
{
    public function getQuestions(Quiz $quiz): Collection
    {
        return $quiz->questions()
            ->with('options')
            ->orderBy('order')
            ->get();
    }

    public function createQuestion(Quiz $quiz, array $data): Question
    {
        return $quiz->questions()->create($data);
    }

    public function updateQuestion(Question $question, array $data): Question
    {
        $question->update($data);

        return $question->refresh();
    }

    public function deleteQuestion(Question $question): void
    {
        $question->delete();
    }

    public function createOption(Question $question, array $data): Option
    {
        return $question->options()->create($data);
    }

    public function updateOption(Option $option, array $data): Option
    {
        $option->update($data);

        return $option->refresh();
    }

    public function deleteOption(Option $option): void
    {
        $option->delete();
    }
}
