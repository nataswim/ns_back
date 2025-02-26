<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanWorkoutSeeder extends Seeder
{
    /**
     * 🇬🇧 Run the database seeds.
     *
     * 🇬🇧 @return void
     */
    public function run()
    {
        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 1,
            'workout_id' => 1,
        ]);

        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 2,
            'workout_id' => 2,
        ]);

        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 3,
            'workout_id' => 3,
        ]);
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 4,
                    'workout_id' => 4,
                ]);
        
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 5,
                    'workout_id' => 5,
                ]);
        
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 6,
                    'workout_id' => 6,
                ]);
                        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 7,
            'workout_id' => 7,
        ]);

        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 8,
            'workout_id' => 8,
        ]);

        // Associer un plan à une séance 
        DB::table('plan_workouts')->insert([
            'plan_id' => 9,
            'workout_id' => 9,
        ]);
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 10,
                    'workout_id' => 10,
                ]);
        
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 11,
                    'workout_id' => 11,
                ]);
        
                // Associer un plan à une séance 
                DB::table('plan_workouts')->insert([
                    'plan_id' => 12,
                    'workout_id' => 12,
                ]);
    }
}