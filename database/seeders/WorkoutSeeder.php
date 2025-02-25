<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workout;
use App\Models\User;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs existants
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('pas d\'utilisateur');
            return;
        }

        // Créer des séances d'entraînement pour chaque utilisateur
        foreach ($users as $user) {
            Workout::create([
                'title' => 'Séance 1',
                'description' => 'Une séance pour travailler quelque chose',
                'workout_category' => 'Aero 1',
                'user_id' => $user->id,
            ]);

            Workout::create([
                'title' => 'Séance 2',
                'description' => 'Une séance pour travailler quelque chose',
                'workout_category' => 'Vitesse',
                'user_id' => $user->id,
            ]);

            Workout::create([
                'title' => 'Séance 2',
                'description' => 'Une séance pour travailler quelque chose',
                'workout_category' => 'Mixte',
                'user_id' => $user->id,
            ]);
        }
    }
}