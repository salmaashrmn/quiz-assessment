<?php

namespace App\Livewire\Public\Quiz;

use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuizResult extends Component
{
    public Submission $submission;

    public function mount(
        Quiz $quiz,
        Submission $submission
    ): void {
        abort_unless($quiz->status === 'published', 404);

        abort_unless($submission->quiz_id === $quiz->id, 404);

        abort_unless($submission->submitted_at !== null, 404);

        $this->submission = $submission->load([
            'quiz.questions',
            'answers.question',
            'answers.option',
        ]);
    }

    public function render(): View
    {
        return view('components.public.quiz.quiz-result');
    }
}
