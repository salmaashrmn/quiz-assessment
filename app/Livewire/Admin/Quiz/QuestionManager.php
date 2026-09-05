<?php

namespace App\Livewire\Admin\Quiz;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Services\QuestionService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuestionManager extends Component
{
    public Quiz $quiz;

    public string $question = '';

    public string $type = 'multiple_choice';

    public ?int $editingQuestionId = null;

    public array $optionInputs = [];

    public array $editingOptions = [];

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function save(QuestionService $questionService): void
    {
        $validated = $this->validate([
            'question' => ['required', 'string'],
            'type' => ['required', 'in:multiple_choice'],
        ]);

        $nextOrder = $this->quiz->questions()->max('order') + 1;

        $questionService->createQuestion($this->quiz, [
            ...$validated,
            'order' => $nextOrder,
        ]);

        $this->reset('question');
        $this->type = 'multiple_choice';
    }

    public function delete(Question $question, QuestionService $questionService): void
    {
        abort_unless($question->quiz_id === $this->quiz->id, 404);

        $questionService->deleteQuestion($question);
    }

    public function render(): View
    {
        $questions = app(QuestionService::class)->getQuestions($this->quiz);

        return view('components.admin.quiz.question-manager', [
            'questions' => $questions,
        ])->layout('layouts.admin');
    }

    public function addOption(
        int $questionId,
        QuestionService $questionService
    ): void {
        $validated = $this->validate([
            "optionInputs.$questionId.option" => ['required', 'string', 'max:255'],
            "optionInputs.$questionId.score" => ['required', 'integer', 'min:0'],
            "optionInputs.$questionId.scoring_key" => ['required', 'string', 'max:50'],
        ]);

        $question = $this->quiz->questions()->findOrFail($questionId);

        $questionService->createOption($question, [
            'option' => $validated['optionInputs'][$questionId]['option'],
            'score' => $validated['optionInputs'][$questionId]['score'],
            'scoring_key' => $validated['optionInputs'][$questionId]['scoring_key']
        ]);

        unset($this->optionInputs[$questionId]);
    }

    public function deleteOption(
        int $optionId,
        QuestionService $questionService
    ): void {
        $option = $this->quiz->questions()
            ->whereHas('options', function ($query) use ($optionId) {
                $query->where('id', $optionId);
            })
            ->firstOrFail()
            ->options()
            ->findOrFail($optionId);

        $questionService->deleteOption($option);
    }
}
