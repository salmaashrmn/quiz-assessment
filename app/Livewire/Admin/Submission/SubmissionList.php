<?php

namespace App\Livewire\Admin\Submission;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SubmissionList extends Component
{
    use WithPagination;

    public function render(): View
    {
        $submissions = Submission::query()
            ->with(['quiz', 'user'])
            ->latest('submitted_at')
            ->paginate(10);

        return view('components.admin.submission.submission-list', [
            'submissions' => $submissions,
        ])->layout('layouts.admin');
    }
}