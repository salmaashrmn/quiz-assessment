<div>
    <div class="admin-page-header">
        <div>
            <span class="admin-page-eyebrow">
                Management
            </span>

            <h1 class="admin-page-title">
                Submissions
            </h1>

            <p class="admin-page-description">
                View quiz submissions and assessment results.
            </p>
        </div>
    </div>

    @if ($submissions->isEmpty())
        <div class="admin-empty-state">
            <h2>No submissions yet</h2>

            <p>
                Submitted quizzes will appear here.
            </p>
        </div>
    @else
        <div class="admin-table-card">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Quiz</th>
                            <th>User</th>
                            <th>Result</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($submissions as $submission)
                            <tr>
                                <td>
                                    <span class="admin-table-primary">
                                        {{ $submission->quiz->title }}
                                    </span>
                                </td>

                                <td>
                                    {{ $submission->user?->name ?? 'Guest' }}
                                </td>

                                <td>
                                    @if ($submission->score != 0)
                                        <span class="admin-score">
                                            {{ $submission->score ?? '-'}}
                                        </span>
                                    @else
                                        <span class="admin-score">
                                            {{ $submission->result ?? '-'}}
                                        </span>
                                    @endif
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
                                    {{ $submission->submitted_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }}
                                </td>

                                <td class="admin-table-action">
                                    <a
                                        href="{{ route('admin.submissions.show', $submission) }}"
                                        class="admin-table-action"
                                    >
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-pagination">
            {{ $submissions->links() }}
        </div>
    @endif
</div>