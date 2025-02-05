<?php

namespace Database\Factories;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil volunteer-event dari tabel pivot
        $volunteerEvent = DB::table('event_user')
            ->where('user_acceptance_status', 'accepted') // Hanya ambil volunteer yang diterima
            ->inRandomOrder()
            ->first();

        if (!$volunteerEvent) {
            throw new \Exception("Tidak ada data volunteer-event yang valid untuk membuat jawaban.");
        }

        // Ambil pertanyaan yang terkait dengan event tersebut
        $question = Questions::where('event_id', $volunteerEvent->event_id)->inRandomOrder()->first();

        if (!$question) {
            throw new \Exception("Tidak ada pertanyaan untuk event dengan ID {$volunteerEvent->event_id}.");
        }

        return [
            'user_id' => $volunteerEvent->user_id,
            'question_id' => $question->id,
            'answer' => $this->faker->paragraph(),
            'status' => $this->faker->boolean(true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
