<div>
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">
                Submission Detail
            </h1>

            <p class="admin-page-description">
                Review the submitted quiz answers.
            </p>
        </div>

        <a
            href="{{ route('admin.submissions.index') }}"
            class="admin-button admin-button-secondary"
        >
            Back to Submissions
        </a>
    </div>

    <div class="admin-detail-grid">

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                Quiz
            </div>

            <div class="admin-detail-value">
                {{ $submission->quiz->title }}
            </div>
        </div>

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                User
            </div>

            <div class="admin-detail-value">
                {{ $submission->user?->name ?? 'Guest' }}
            </div>
        </div>

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                Result
            </div>

            @if ($submission->score != 0)
                <div class="admin-detail-score">
                    {{ $submission->score ?? '-' }}
                </div>
            @else
                <div class="admin-detail-score">
                    {{ $submission->result ?? '-'}}
                </div>
            @endif
        </div>

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                Status
            </div>

            <div>
                @if ($submission->submitted_at)
                    <span class="admin-status admin-status-published">
                        Completed
                    </span>
                @else
                    <span class="admin-status admin-status-draft">
                        In Progress
                    </span>
                @endif
            </div>
        </div>

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                Started At
            </div>

            <div class="admin-detail-value">
                {{ $submission->started_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }}
            </div>
        </div>

        <div class="admin-detail-card">
            <div class="admin-detail-label">
                Submitted At
            </div>

            <div class="admin-detail-value">
                {{ $submission->submitted_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }}
            </div>
        </div>

    </div>

    <div class="admin-section-card">
        <div class="admin-section-header">
            <div>
                <h2 class="admin-section-title">
                    Answer Review
                </h2>

                <p class="admin-page-description">
                    Review each question and the selected answer.
                </p>
            </div>
        </div>

        <div class="admin-submission-answers">
            @foreach ($submission->quiz->questions as $index => $question)
                @php
                    $answer = $submission->answers
                        ->firstWhere('question_id', $question->id);
                @endphp

                <div class="admin-submission-question">

                    <div class="admin-submission-question-header">
                        <span class="admin-question-number">
                            Question {{ $index + 1 }}
                        </span>

                        @if ($answer)
                            <span class="admin-answer-status">
                                Answered
                            </span>
                        @else
                            <span class="admin-answer-status admin-answer-status-empty">
                                Not Answered
                            </span>
                        @endif
                    </div>

                    <div class="admin-submission-question-text">
                        {{ $question->question }}
                    </div>

                    <div class="admin-submission-options">
                        @foreach ($question->options as $option)
                            <div
                                class="
                                    admin-submission-option
                                    {{ $answer?->option_id === $option->id
                                        ? 'selected'
                                        : '' }}
                                "
                            >
                                <span>
                                    {{ $option->option }}
                                </span>

                                <span class="admin-option-score">
                                    {{ $option->score }} pts
                                </span>
                            </div>
                        @endforeach
                    </div>

                    @if ($answer)
                        <div class="admin-selected-answer">
                            Selected answer:
                            <strong>
                                {{ $answer->option->option }}
                            </strong>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
</div>