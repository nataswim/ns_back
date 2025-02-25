<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanWorkoutController extends Controller
{
    /**
     * Display a listing of the workouts for a given plan.
     */
    public function index(Plan $plan)
    {
        return response()->json($plan->workouts, 200);
    }

    /**
     * Attach a workout to a plan.
     */
    public function store(Request $request, Plan $plan, Workout $workout)
    {
        // Validation pour la méthode store 
        $validator = Validator::make([
            'plan_id' => $plan->id,
            'workout_id' => $workout->id,
        ], [
            'plan_id' => 'exists:plans,id',
            'workout_id' => 'exists:workouts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Vérifier si l'association existe déjà
        if ($plan->workouts()->where('workout_id', $workout->id)->exists()) {
            return response()->json(['error' => 'Workout already attached to this plan.'], 400);
        }

        $plan->workouts()->attach($workout->id);
        return response()->json(['message' => 'Workout attached successfully.'], 201);
    }

    /**
     * Detach a workout from a plan.
     */
    public function destroy(Plan $plan, Workout $workout)
    {
        // Vérifier si l'association existe avant suppression 
        if (!$plan->workouts()->where('workout_id', $workout->id)->exists()) {
            return response()->json(['error' => 'Workout is not attached to this plan.'], 400);
        }

        $plan->workouts()->detach($workout->id);
        return response()->json(null, 204);
    }

    /**
     * la méthode show 
     */
    public function show(Plan $plan, Workout $workout)
    {
        if ($plan->workouts->contains($workout)) {
            return response()->json($workout, 200);
        } else {
            return response()->json(['message' => 'Workout not found in plan.'], 404);
        }
    }
}