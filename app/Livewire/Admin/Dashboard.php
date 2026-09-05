<?php

namespace App\Livewire\Admin;

use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        $stats = [
            'totalQuizzes' => Quiz::count(),
            'publishedQuizzes' => Quiz::where('status', 'published')->count(),
            'totalSubmissions' => Submission::count(),
            'completedSubmissions' => Submission::whereNotNull('submitted_at')->count(),
        ];

        $recentSubmissions = Submission::query()
            ->with(['quiz', 'user'])
            ->latest('created_at')
            ->limit(5)
            ->get();

        $quizOverview = Quiz::query()
            ->withCount('questions')
            ->latest()
            ->limit(5)
            ->get();

        return view('components.admin.dashboard', [
            'stats' => $stats,
            'recentSubmissions' => $recentSubmissions,
            'quizOverview' => $quizOverview,
        ])->layout('layouts.admin');
    }
}