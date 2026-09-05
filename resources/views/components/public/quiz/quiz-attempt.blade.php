<div class="quiz-attempt">
    <article class="quiz-attempt-card">
        @php
            $question = $quiz->questions[$currentQuestion];
            $totalQuestions = $quiz->questions->count();
        @endphp

        <div class="quiz-attempt-header">
            <span class="quiz-attempt-number">
                Question {{ $currentQuestion + 1 }} of {{ $totalQuestions }}
            </span>

            <h1>{{ $quiz->title }}</h1>
        </div>

        <div class="quiz-attempt-question"
                wire:key="question-{{ $question->id }}">
            <h2>
                {{ $question->question }}
            </h2>

            <div class="quiz-options">
                @foreach ($question->options as $option)
                    <label class="quiz-option">
                        <input
                            type="radio"
                            wire:model="answers.{{ $question->id }}"
                            value="{{ $option->id }}"
                        >

                        <span>{{ $option->option }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="quiz-attempt-actions">
            @if ($currentQuestion === 0)
                <button
                    type="button"
                    wire:click="cancel"
                    class="quiz-attempt-button quiz-attempt-button-secondary"
                >
                    Back
                </button>
            @else
            <button
                type="button"
                wire:click="previous"
                wire:loading.attr="disabled"
                wire:target="previous"
                class="quiz-attempt-button quiz-attempt-button-secondary"
            >
                <span wire:loading.remove wire:target="previous">
                    Previous
                </span>
            
                <span
                    wire:loading
                    wire:target="previous"
                    class="quiz-spinner"
                ></span>
            </button>
            @endif

            @if ($currentQuestion < $totalQuestions - 1)
                <button
                    type="button"
                    wire:click="next"
                    wire:loading.attr="disabled"
                    wire:target="next"
                    class="quiz-attempt-button quiz-attempt-button-primary"
                >
                    <span wire:loading.remove wire:target="next">
                        Next
                    </span>
                
                    <span
                        wire:loading
                        wire:target="next"
                        class="quiz-spinner"
                    ></span>
                </button>
            @else
            <button
                type="button"
                wire:click="submit"
                wire:loading.attr="disabled"
                wire:target="submit"
                class="quiz-attempt-button quiz-attempt-button-primary"
            >
                <span wire:loading.remove wire:target="submit">
                    Submit
                </span>
            
                <span
                    wire:loading
                    wire:target="submit"
                    class="quiz-spinner"
                ></span>
            </button>
            @endif
        </div>
    </article>
</div>