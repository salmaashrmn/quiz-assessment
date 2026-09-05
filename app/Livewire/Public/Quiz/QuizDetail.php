<?php

namespace App\Livewire\Public\Quiz;

use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuizDetail extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz): void
    {
        abort_unless($quiz->status === 'published', 404);

        $this->quiz = $quiz->load('questions');
    }

    public function start(): void
    {
        $submission = Submission::create([
            'quiz_id' => $this->quiz->id,
            'user_id' => auth()->id(),
            'started_at' => now(),
        ]);

        $this->redirectRoute('quizzes.attempt', [
            'quiz' => $this->quiz,
            'submission' => $submission,
        ]);
    }

    public function render(): View
    {
        return view('components.public.quiz.quiz-detail');
    }
}
