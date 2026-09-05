<?php

namespace App\Livewire\Admin\Quiz;

use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuizForm extends Component
{
    public ?Quiz $quiz = null;

    public string $title = '';

    public string $description = '';

    public string $status = 'draft';

    public function mount(?Quiz $quiz = null): void
    {
        $this->quiz = $quiz;

        if ($quiz) {
            $this->title = $quiz->title;
            $this->description = $quiz->description ?? '';
            $this->status = $quiz->status;
        }
    }

    public function save(QuizService $quizService): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        if ($this->quiz) {
            $quizService->updateQuiz($this->quiz, $validated);
        } else {
            $quizService->createQuiz($validated);
        }

        $this->redirectRoute('admin.quizzes.index');
    }

    public function render(): View
    {
        return view('components.admin.quiz.quiz-form')
            ->layout('layouts.admin');
    }
}
