<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mylist;
use App\Models\MylistItem;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\Plan;

class MylistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les listes personnelles, exercices, workouts et plans existants
        $mylists = Mylist::all();
        $exercises = Exercise::all();
        $workouts = Workout::all();
        $plans = Plan::all();

        if ($mylists->isEmpty() || $exercises->isEmpty() || $workouts->isEmpty() || $plans->isEmpty()) {
            $this->command->info('Pas de  mylists, exercises, workouts, seeder les avant.');
            return;
        }

        // Ajouter des éléments aux listes personnelles
        foreach ($mylists as $mylist) {
            // Ajouter un exercice
            if ($exercises->isNotEmpty()) {
                MylistItem::create([
                    'mylist_id' => $mylist->id,
                    'item_id' => $exercises->random()->id,
                    'item_type' => 'App\Models\Exercise',
                ]);
            }

            // Ajouter un workout
            if ($workouts->isNotEmpty()) {
                MylistItem::create([
                    'mylist_id' => $mylist->id,
                    'item_id' => $workouts->random()->id,
                    'item_type' => 'App\Models\Workout',
                ]);
            }

            // Ajouter un plan
            if ($plans->isNotEmpty()) {
                MylistItem::create([
                    'mylist_id' => $mylist->id,
                    'item_id' => $plans->random()->id,
                    'item_type' => 'App\Models\Plan',
                ]);
            }
        }
    }
}