<?php

namespace App\Livewire\Public\Quiz;

use App\Services\QuizService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PublicQuizList extends Component
{
    public function render(QuizService $quizService): View
    {
        $quizzes = $quizService->getPublishedQuizzes();

        return view('components.public.quiz.quiz-list', [
            'quizzes' => $quizzes,
        ]);
    }
}
