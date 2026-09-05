<?php

namespace App\Livewire\Admin\Quiz;

use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class QuizList extends Component
{
    use WithPagination;

    public function delete(Quiz $quiz, QuizService $quizService): void
    {
        $quizService->deleteQuiz($quiz);

        $this->resetPage();
    }

    public function render(): View
    {
        $quizzes = app(QuizService::class)->getQuizzes();

        return view('components.admin.quiz.quiz-list', [
            'quizzes' => $quizzes,
        ])->layout('layouts.admin');
    }
}
