<div>
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">
                Quizzes Management
            </h1>

            <p class="admin-page-description">
                Create and manage quizzes and their questions.
            </p>
        </div>

        <a
            href="{{ route('admin.quizzes.create') }}"
            class="admin-button admin-button-primary"
        >
            + Create Quiz
        </a>
    </div>

    @if ($quizzes->isEmpty())
        <div class="admin-empty-state">
            <h2>No quizzes yet</h2>

            <p>
                Create your first quiz to get started.
            </p>

            <a
                href="{{ route('admin.quizzes.create') }}"
                class="admin-button admin-button-primary"
            >
                Create Quiz
            </a>
        </div>
    @else
        <div class="admin-quiz-list">
            @foreach ($quizzes as $quiz)
                <article class="admin-quiz-card">

                    <div class="admin-quiz-card-content">
                        <h2>
                            {{ $quiz->title }}
                        </h2>

                        <p>
                            {{ $quiz->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <div class="admin-quiz-card-meta">
                        <span class="admin-status admin-status-{{ $quiz->status }}">
                            {{ ucfirst($quiz->status) }}
                        </span>

                        <span>
                            {{ $quiz->questions_count }} questions
                        </span>
                    </div>

                    <div class="admin-quiz-card-actions">
                        <a
                            href="{{ route('admin.quizzes.edit', $quiz) }}"
                            class="admin-action admin-action-edit"
                        >
                            Edit
                        </a>

                        <a
                            href="{{ route('admin.quizzes.questions', $quiz) }}"
                            class="admin-action admin-action-manage"
                        >
                            Questions
                        </a>

                        <button
                            type="button"
                            wire:click="delete({{ $quiz->id }})"
                            wire:confirm="Are you sure you want to delete this quiz?"
                            class="admin-action admin-action-delete"
                        >
                            Delete
                        </button>
                    </div>

                </article>
            @endforeach
        </div>

        <div class="admin-pagination">
            {{ $quizzes->links() }}
        </div>
    @endif
</div>