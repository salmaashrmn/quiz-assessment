<?php

namespace App\Livewire\Admin\Submission;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SubmissionDetail extends Component
{
    public Submission $submission;

    public function mount(Submission $submission): void
    {
        $this->submission = $submission->load([
            'quiz.questions.options',
            'user',
            'answers.question',
            'answers.option',
        ]);
    }

    public function render(): View
    {
        return view('components.admin.submission.submission-detail')
            ->layout('layouts.admin');
    }
}