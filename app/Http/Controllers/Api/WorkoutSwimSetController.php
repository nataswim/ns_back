<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use App\Models\SwimSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutSwimSetController extends Controller
{
    /**
     * Display a listing of the swim sets for a given workout.
     */
    public function index(Workout $workout)
    {
        return response()->json($workout->swimSets, 200);
    }

    /**
     * Attach a swim set to a workout.
     */
    public function store(Request $request, Workout $workout, SwimSet $swimSet) // Ajout de SwimSet dans l'injection
    {
        // Pas de validation ici, car l'ID de swimSet est déjà validé par l'injection de dépendances

        // Vérifier si l'association existe déjà
        if ($workout->swimSets()->where('swim_set_id', $swimSet->id)->exists()) {
            return response()->json(['error' => 'Swim set already attached to this workout.'], 400);
        }

        $workout->swimSets()->attach($swimSet->id); // Utiliser l'ID directement
        return response()->json(['message' => 'Swim set attached successfully.'], 201);
    }

    /**
     * Detach a swim set from a workout.
     */
    public function destroy(Workout $workout, SwimSet $swimSet)  // Ajout de SwimSet dans l'injection
    {
         // Vérifier si l'association existe avant de détacher
        if (!$workout->swimSets()->where('swim_set_id', $swimSet->id)->exists()) {
            return response()->json(['error' => 'Swim set is not attached to this workout.'], 400);
        }

        $workout->swimSets()->detach($swimSet->id); // Utiliser l'ID directement
        return response()->json(null, 204);
    }
}