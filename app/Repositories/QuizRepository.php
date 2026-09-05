<?php

namespace App\Repositories;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QuizRepository
{
    public function getPublishedQuizzes(): Collection
    {
        return Quiz::query()
            ->where('status', 'published')
            ->with('questions.options')
            ->latest()
            ->get();
    }

    public function getQuizzes(): LengthAwarePaginator
    {
        return Quiz::query()
            ->withCount('questions')
            ->latest()
            ->paginate(10);
    }

    public function createQuiz(array $data): Quiz
    {
        return Quiz::create($data);
    }

    public function updateQuiz(Quiz $quiz, array $data): Quiz
    {
        $quiz->update($data);

        return $quiz->refresh();
    }

    public function deleteQuiz(Quiz $quiz): void
    {
        $quiz->delete();
    }
}
