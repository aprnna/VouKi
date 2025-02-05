<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Questions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            // Buat 3 pertanyaan untuk setiap acara
            Questions::factory()->count(3)->create([
                'event_id' => $event->id,
                'created_at' => $event->EventStart,
                'updated_at' => $event->EventEnd
            ]);
        }
    }
}
