<?php

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => \App\Models\Quiz::factory(),
            'user_id' => null,
            'started_at' => now(),
            'submitted_at' => null,
            'score' => null,
            'result' => null
        ];
    }
}
