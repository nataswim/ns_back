<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role; // Importez le modèle Role
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les rôles par leur nom
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $athletRole = Role::where('name', 'athlet')->first();
        $coachRole = Role::where('name', 'coach')->first();

        // Créer les utilisateurs
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.net',
            'password' => Hash::make('admin123'),
            'first_name' => 'Hassan',
            'last_name' => 'ELHAOUAT',
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'username' => 'user1',
            'email' => 'user@user.net',
            'password' => Hash::make('user123'),
            'first_name' => 'Hassan1',
            'last_name' => 'ELHAOUAT2',
            'role_id' => $userRole->id,
        ]);

        User::create([
            'username' => 'athlet',
            'email' => 'athlet@athlet.net',
            'password' => Hash::make('athlet123'),
            'first_name' => 'athlet',
            'last_name' => 'sportif',
            'role_id' => $athletRole->id,
        ]);

        User::create([
            'username' => 'coach',
            'email' => 'coach@coach.net',
            'password' => Hash::make('coach123'),
            'first_name' => 'coach',
            'last_name' => 'entraineur',
            'role_id' => $coachRole->id,
        ]);
    }
}
