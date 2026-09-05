<div class="quiz-result">
    <article class="quiz-result-card">
        <div class="quiz-detail-content">
            <h1>Quiz Result</h1>
            <h2>{{ $submission->quiz->title }}</h2>

            @if ($submission->result != null)
                <p class="quiz-result-label">
                    Your Result
                </p>

                <div class="quiz-result-value">
                    {{ $submission->result }}
                </div>
            @else
                <p class="quiz-result-score">
                    Score: {{ $submission->score }}
                </p>
            @endif
        
            <p>
                Submitted at: {{ $submission->submitted_at->format('d M Y') }}
            </p>
        </div>

        <div class="quiz-detail-actions">
            <a
                href="{{ route('quizzes.index') }}"
                class="quiz-detail-back"
            >
                Back to Quizzes
            </a>
        </div>
    </article>
</div>