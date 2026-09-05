<?php

namespace App\Services;

use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QuizService
{
    public function __construct(
        private QuizRepository $quizRepository
    ) {}

    public function getPublishedQuizzes(): Collection
    {
        return $this->quizRepository->getPublishedQuizzes();
    }

    public function getQuizzes(): LengthAwarePaginator
    {
        return $this->quizRepository->getQuizzes();
    }

    public function createQuiz(array $data): Quiz
    {
        return $this->quizRepository->createQuiz($data);
    }

    public function updateQuiz(Quiz $quiz, array $data): Quiz
    {
        return $this->quizRepository->updateQuiz($quiz, $data);
    }

    public function deleteQuiz(Quiz $quiz): void
    {
        $this->quizRepository->deleteQuiz($quiz);
    }
}