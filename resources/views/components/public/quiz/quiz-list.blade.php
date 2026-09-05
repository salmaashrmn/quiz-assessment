<div>
    <h1 class="text-xl font-bold">Available Quizzes</h1>

    @if ($quizzes->isEmpty())
        <p>No quizzes available.</p>
    @else
        <div class="quiz-list">
            @foreach ($quizzes as $quiz)
                <article class="quiz-card">
                    <h2>{{ $quiz->title }}</h2>

                    <p class="quiz-card-description">
                        {{ $quiz->description }}
                    </p>

                    <div class="quiz-card-meta">
                        {{ $quiz->questions->count() }} questions
                    </div>

                    <a
                        href="{{ route('quizzes.show', $quiz) }}"
                        class="quiz-card-button"
                    >
                        View Quiz
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</div>