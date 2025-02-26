<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use App\Models\Exercise;
use App\Models\User;
use App\Models\Upload; 

class ExerciseSeeder extends Seeder
{
    /**
     * 🇬🇧 Run the database seeds 
     */
    public function run(): void
    {
        // Récupérer les utilisateurs et uploads existants
        $users = User::all();
        $uploads = Upload::all();

        if ($users->isEmpty()) {
            $this->command->info('pas d\'utilisateur');
            return;
        }

        // Créer des exercices pour chaque utilisateur 
        foreach ($users as $user) {
            Exercise::create([
                'title' => 'Educatif 1',
                'description' => 'Exercice Educatif pour corriger et travailler la dissociation ségmentaire.',
                'exercise_level' => 'Intermédiaire',
                'exercise_category' => 'Correctif De Nage',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);

            Exercise::create([
                'title' => 'Educatif 1',
                'description' => 'Exercice Educatif pour corriger et travailler la posture et l\'alignement',
                'exercise_level' => 'Débutant',
                'exercise_category' => 'Correctif De Style',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);

            Exercise::create([
                'title' => 'Battements de Jambes',
                'description' => 'Exercice pour travailler l\'execution et l\'endurance du bas du corps.',
                'exercise_level' => 'Avancé',
                'exercise_category' => 'Travail de Base',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);
        }
    }
}