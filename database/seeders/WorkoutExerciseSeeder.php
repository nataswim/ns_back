<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 1,
            'exercise_id' => 1,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 2,
            'exercise_id' => 2,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 3,
            'exercise_id' => 3,
        ]);
        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 4,
            'exercise_id' => 4,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 5,
            'exercise_id' => 5,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 6,
            'exercise_id' => 6,
        ]);
        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 7,
            'exercise_id' => 7,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 8,
            'exercise_id' => 8,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 9,
            'exercise_id' => 9,
        ]);
        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 10,
            'exercise_id' => 10,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 11,
            'exercise_id' => 11,
        ]);

        // Exemple : Associer une séance d'entraînement à un exercice 
        DB::table('workout_exercises')->insert([
            'workout_id' => 12,
            'exercise_id' => 12,
        ]);
    }
}
