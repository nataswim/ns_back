<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;
use App\Models\Upload;

class PageSeeder extends Seeder
{
    /**
     * 🇬🇧 Run the database seeds.
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

        // Créer des pages pour chaque utilisateur
        foreach ($users as $user) {
            Page::create([
                'title' => 'À propos',
                'content' => 'Bienvenue sur notre application pour Tous',
                'page_category' => 'Information',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);

            Page::create([
                'title' => 'CGU - Conditions d\'utilisation',
                'content' => 'Veuillez lire nos conditions d\'utilisation.',
                'page_category' => 'Information',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);

            Page::create([
                'title' => 'Conseils d\'utilisation',
                'content' => 'Voici quelques conseils pour améliorer vos performances.',
                'page_category' => 'Conseils',
                'upload_id' => $uploads->random()->id ?? null,
                'user_id' => $user->id,
            ]);
        }
    }
}