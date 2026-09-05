@php
    use Illuminate\Support\Str;
@endphp
<div>
    <div class="admin-page-header">
        <div>
            <span class="admin-page-eyebrow">
                Quiz Management
            </span>

            <h1 class="admin-page-title">
                Questions
            </h1>

            <p class="admin-page-description">
                Manage questions and answer options for
                <strong>{{ $quiz->title }}</strong>.
            </p>
        </div>

        <a
            href="{{ route('admin.quizzes.index') }}"
            class="admin-button admin-button-secondary"
        >
            Back to Quizzes
        </a>
    </div>

    {{-- Add Question --}}
    <section class="admin-section-card">
        <div class="admin-section-header">
            <div>
                <h2>Add Question</h2>

                <p>
                    Create a new question for this quiz.
                </p>
            </div>
        </div>

        <form wire:submit="save">
            <div class="admin-form-group">
                <label
                    for="question"
                    class="admin-form-label"
                >
                    Question
                </label>

                <textarea
                    id="question"
                    wire:model="question"
                    class="admin-form-textarea"
                    rows="4"
                    placeholder="Enter your question"
                ></textarea>

                @error('question')
                    <span class="admin-form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="admin-question-form-footer">
                <div class="admin-form-group admin-question-type">
                    <label
                        for="type"
                        class="admin-form-label"
                    >
                        Type
                    </label>

                    <select
                        id="type"
                        wire:model="type"
                        class="admin-form-select"
                    >
                        <option value="multiple_choice">
                            Multiple Choice
                        </option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="admin-button admin-button-primary"
                    wire:loading.attr="disabled"
                    wire:target="save"
                >
                    <span wire:loading.remove wire:target="save">
                        Add Question
                    </span>

                    <span wire:loading wire:target="save">
                        Adding...
                    </span>
                </button>
            </div>
        </form>
    </section>

    {{-- Questions --}}
    <div class="admin-section-title">
        <h2>Questions</h2>

        <span>
            {{ $questions->count() }}
            {{ Str::plural('question', $questions->count()) }}
        </span>
    </div>

    @if ($questions->isEmpty())
        <div class="admin-empty-state">
            <h2>No questions yet</h2>

            <p>
                Add a question to start building this quiz.
            </p>
        </div>
    @else
        <div class="admin-question-list">
            @foreach ($questions as $question)
                <article class="admin-question-card">

                    <div class="admin-question-header">
                        <div>
                            <span class="admin-question-number">
                                Question {{ $loop->iteration }}
                            </span>

                            <h2>
                                {{ $question->question }}
                            </h2>
                        </div>

                        <button
                            type="button"
                            wire:click="delete({{ $question->id }})"
                            wire:confirm="Are you sure you want to delete this question?"
                            class="admin-action admin-action-delete"
                        >
                            Delete Question
                        </button>
                    </div>

                    <div class="admin-options-section">
                        <div class="admin-options-header">
                            <h3>Answer Options</h3>

                            <span>
                                {{ $question->options->count() }}
                                {{ Str::plural('option', $question->options->count()) }}
                            </span>
                        </div>

                        @if ($question->options->isNotEmpty())
                            <div class="admin-option-list">
                                @foreach ($question->options as $option)
                                    <div class="admin-option-row">
                                        <div class="admin-option-content">
                                            <span class="admin-option-label">
                                                {{ $option->option }}
                                            </span>

                                            <span class="admin-option-score">
                                                Score: {{ $option->score }}
                                            </span>
                                        </div>

                                        <div class="admin-option-actions">
                                            <button
                                                type="button"
                                                wire:click="deleteOption({{ $option->id }})"
                                                wire:confirm="Are you sure you want to delete this option?"
                                                class="admin-action admin-action-delete"
                                            >
                                                Delete
                                            </button>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Add Option --}}
                        <form
                            wire:submit="addOption({{ $question->id }})"
                            class="admin-add-option"
                        >
                            <input
                                type="text"
                                wire:model="optionInputs.{{ $question->id }}.option"
                                class="admin-form-input"
                                placeholder="Enter answer option"
                            >

                            <input
                                type="number"
                                wire:model="optionInputs.{{ $question->id }}.score"
                                class="admin-form-input admin-score-input"
                                placeholder="Score"
                                min="0"
                            >

                            <input
                                type="text"
                                wire:model="optionInputs.{{ $question->id }}.scoring_key"
                                class="admin-form-input"
                                placeholder="Enter Scoring Key"
                            >

                            <button
                                type="submit"
                                class="admin-button admin-button-primary"
                                wire:loading.attr="disabled"
                                wire:target="addOption({{ $question->id }})"
                            >
                                Add Option
                            </button>
                        </form>

                        @error("optionInputs.{$question->id}.option")
                            <span class="admin-form-error">
                                {{ $message }}
                            </span>
                        @enderror

                        @error("optionInputs.{$question->id}.score")
                            <span class="admin-form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </article>
            @endforeach
        </div>
    @endif
</div>