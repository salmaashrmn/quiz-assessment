<div class="quiz-detail">
    <article class="quiz-detail-card">
        <div class="quiz-detail-content">
            <h1>{{ $quiz->title }}</h1>

            <p class="quiz-detail-description">
                {{ $quiz->description }}
            </p>

            <div class="quiz-detail-meta">
                {{ $quiz->questions->count() }} questions
            </div>
        </div>

        <div class="quiz-detail-actions">
            <a
                href="{{ route('quizzes.index') }}"
                class="quiz-detail-back"
            >
                Back
            </a>

            <button
                type="button"
                wire:click="start"
                class="quiz-detail-start"
            >
                Start Quiz
            </button>
        </div>
    </article>
</div>