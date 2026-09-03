<?php

namespace Database\Factories;

use App\Models\SubmissionAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubmissionAnswer>
 */
class SubmissionAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submission_id' => \App\Models\Submission::factory(),
            'question_id' => \App\Models\Question::factory(),
            'option_id' => \App\Models\Option::factory(),
        ];
    }
}
