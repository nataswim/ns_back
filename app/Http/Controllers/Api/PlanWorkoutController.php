<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Workout;
use Illuminate\Http\Request;

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
        // Pas de validation ici, car l'ID de workout est déjà validé par l'injection de dépendances

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
        // Vérifier si l'association existe avant de détacher
        if (!$plan->workouts()->where('workout_id', $workout->id)->exists()) {
            return response()->json(['error' => 'Workout is not attached to this plan.'], 400);
        }

        $plan->workouts()->detach($workout->id);
        return response()->json(null, 204);
    }
}