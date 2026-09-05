<?php

namespace App\Livewire\Public\Quiz;

use App\Models\Quiz;
use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuizAttempt extends Component
{
    public Quiz $quiz;
    public Submission $submission;
    public array $answers = [];
    public int $currentQuestion = 0;

    public function mount(Quiz $quiz, Submission $submission): void
    {
        abort_unless($quiz->status === 'published', 404);
        abort_unless($submission->quiz_id === $quiz->id, 404);
        abort_unless($submission->submitted_at === null, 404);

        $this->quiz = $quiz->load([
            'questions' => fn ($query) => $query->orderBy('order'),
            'questions.options',
        ]);

        $this->submission = $submission;
    }

    public function next(): void
    {
        if ($this->currentQuestion < $this->quiz->questions->count() - 1) {
            $this->currentQuestion++;
        }
    }

    public function previous(): void
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    public function cancel(): void
    {
        $this->submission->delete();

        $this->redirectRoute('quizzes.index');
    }

    public function submit(SubmissionService $submissionService): void
    {
        logger()->info('ANSWERS BEFORE SUBMIT', [
            'answers' => $this->answers,
            'count' => count($this->answers),
        ]);
        
        $submissionService->submit(
            $this->submission,
            $this->answers
        );

        $this->redirectRoute('quizzes.result', [
            'quiz' => $this->quiz,
            'submission' => $this->submission,
        ]);
    }

    public function render(): View
    {
        return view('components.public.quiz.quiz-attempt');
    }
}
