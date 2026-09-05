<div>
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">
                Dashboard
            </h1>

            <p class="admin-page-description">
                Overview of your quiz assessment system.
            </p>
        </div>
    </div>

    <div class="admin-stats-grid">

        <div class="admin-stat-card">
            <div class="admin-stat-label">
                Total Quizzes
            </div>

            <div class="admin-stat-value">
                {{ $stats['totalQuizzes'] }}
            </div>
        </div>

        <div class="admin-stat-card">
            <div class="admin-stat-label">
                Published Quizzes
            </div>

            <div class="admin-stat-value">
                {{ $stats['publishedQuizzes'] }}
            </div>
        </div>

        <div class="admin-stat-card">
            <div class="admin-stat-label">
                Total Submissions
            </div>

            <div class="admin-stat-value">
                {{ $stats['totalSubmissions'] }}
            </div>
        </div>

        <div class="admin-stat-card">
            <div class="admin-stat-label">
                Completed Submissions
            </div>

            <div class="admin-stat-value">
                {{ $stats['completedSubmissions'] }}
            </div>
        </div>

    </div>

    <div class="admin-dashboard-grid">

        <div class="admin-section-card">
            <div class="admin-section-header">
                <div>
                    <h2 class="admin-section-title">
                        Recent Submissions
                    </h2>

                    <p class="admin-page-description">
                        Latest quiz attempts.
                    </p>
                </div>

                <a
                    href="{{ route('admin.submissions.index') }}"
                    class="admin-table-action"
                >
                    View All
                </a>
            </div>

            @if ($recentSubmissions->isEmpty())
                <div class="admin-empty-state">
                    <p>No submissions yet.</p>
                </div>
            @else
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Quiz</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($recentSubmissions as $submission)
                                <tr>
                                    <td class="admin-table-primary">
                                        {{ $submission->quiz->title }}
                                    </td>

                                    <td>
                                        {{ $submission->user?->name ?? 'Guest' }}
                                    </td>

                                    <td>
                                        @if ($submission->submitted_at)
                                            <span class="admin-status admin-status-published">
                                                Completed
                                            </span>
                                        @else
                                            <span class="admin-status admin-status-draft">
                                                In Progress
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $submission->submitted_at
                                            ? $submission->submitted_at
                                                ->timezone('Asia/Jakarta')
                                                ->format('d M Y, H:i')
                                            : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="admin-section-card">
            <div class="admin-section-header">
                <div>
                    <h2 class="admin-section-title">
                        Quiz Overview
                    </h2>

                    <p class="admin-page-description">
                        Recently created quizzes.
                    </p>
                </div>

                <a
                    href="{{ route('admin.quizzes.index') }}"
                    class="admin-table-action"
                >
                    View All
                </a>
            </div>

            @if ($quizOverview->isEmpty())
                <div class="admin-empty-state">
                    <p>No quizzes yet.</p>
                </div>
            @else
                <div class="admin-dashboard-quiz-list">
                    @foreach ($quizOverview as $quiz)
                        <div class="admin-dashboard-quiz-item">

                            <div>
                                <div class="admin-dashboard-quiz-title">
                                    {{ $quiz->title }}
                                </div>

                                <div class="admin-dashboard-quiz-meta">
                                    {{ $quiz->questions_count }}
                                    {{ Str::plural('question', $quiz->questions_count) }}
                                </div>
                            </div>

                            <span
                                class="
                                    admin-status
                                    {{ $quiz->status === 'published'
                                        ? 'admin-status-published'
                                        : 'admin-status-draft' }}
                                "
                            >
                                {{ ucfirst($quiz->status) }}
                            </span>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>