<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Upload;
use App\Models\User;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs existants
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('Aucun utilisateur dans la BdD');
            return;
        }

        // Créer des uploads pour chaque utilisateur
        foreach ($users as $user) {
            Upload::create([
                'filename' => 'example1.jpg',
                'path' => 'uploads/example1.jpg',
                'type' => 'image',
                'user_id' => $user->id,
            ]);

            Upload::create([
                'filename' => 'example2.pdf',
                'path' => 'uploads/example2.pdf',
                'type' => 'document',
                'user_id' => $user->id,
            ]);
        }
    }
}