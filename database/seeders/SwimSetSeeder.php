<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SwimSet;
use App\Models\Workout;
use App\Models\Exercise;

class SwimSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les workouts et exercices existants
        $workouts = Workout::all();
        $exercises = Exercise::all();

        if ($workouts->isEmpty() || $exercises->isEmpty()) {
            $this->command->info('No workouts or exercises found. Please seed them first.');
            return;
        }

        // Créer des séries de natation pour chaque workout et exercice
        foreach ($workouts as $workout) {
            foreach ($exercises as $exercise) {
                SwimSet::create([
                    'workout_id' => $workout->id,
                    'exercise_id' => $exercise->id,
                    'set_distance' => rand(25, 200),
                    'set_repetition' => rand(1, 10),
                    'rest_time' => rand(15, 60),
                ]);

                SwimSet::create([
                    'workout_id' => $workout->id,
                    'exercise_id' => $exercise->id,
                    'set_distance' => rand(50, 400),
                    'set_repetition' => rand(1, 5),
                    'rest_time' => rand(30, 90),
                ]);
            }
        }
    }
}