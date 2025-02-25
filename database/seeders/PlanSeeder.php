<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\User;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs existants
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Please seed users first.');
            return;
        }

        // Créer des plans pour chaque utilisateur
        foreach ($users as $user) {
            Plan::create([
                'title' => 'Plan d\'entraînement débutant',
                'description' => 'Un plan simple pour les débutants.',
                'plan_category' => 'Débutant',
                'user_id' => $user->id,
            ]);

            Plan::create([
                'title' => 'Plan d\'entraînement intermédiaire',
                'description' => 'Un plan pour ceux qui ont déjà une expérience.',
                'plan_category' => 'Intermédiaire',
                'user_id' => $user->id,
            ]);

            Plan::create([
                'title' => 'Plan d\'entraînement avancé',
                'description' => 'Un plan intensif pour les athlètes avancés.',
                'plan_category' => 'Avancé',
                'user_id' => $user->id,
            ]);
        }
    }
}