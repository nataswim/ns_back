<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mylist;
use App\Models\User;

class MylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs existants
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('verifier les utilisateurs dans la BdD');
            return;
        }

        // Créer des listes personnelles pour chaque utilisateur
        foreach ($users as $user) {
            Mylist::create([
                'user_id' => $user->id,
                'title' => 'Mes exercices favoris',
                'description' => 'Une liste de mes exercices préférés.',
            ]);

            Mylist::create([
                'user_id' => $user->id,
                'title' => 'Mes séances favorites',
                'description' => 'Une liste de mes séances  préférées.',
            ]);

            Mylist::create([
                'user_id' => $user->id,
                'title' => 'Mes plans de favoris',
                'description' => 'Une liste de mes plans préférées.',
            ]);
        }
    }
}