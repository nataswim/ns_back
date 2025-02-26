<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * 🇬🇧 Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            //OK RoleSeeder::class,
            //OK UserSeeder::class,
            //OK UploadSeeder::class,
            // ok ExerciseSeeder::class,
            // ok PageSeeder::class,
            //ok PlanSeeder::class,
            // ok WorkoutSeeder::class,
            // ok SwimSetSeeder::class,
            // ok MylistSeeder::class,
            // ok MylistItemSeeder::class,
            // ok PlanWorkoutSeeder::class,
            // WorkoutExerciseSeeder::class,
            WorkoutSwimSetSeeder::class,
        ]);
    }
}
