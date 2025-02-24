<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutExerciseController extends Controller
{
    /**
     * Display a listing of the exercises for a given workout.
     */
    public function index(Workout $workout)
    {
        return response()->json($workout->exercises, 200);
    }

    /**
     * Attach an exercise to a workout.
     */
    public function store(Request $request, Workout $workout)
    {
        $validator = Validator::make($request->all(), [
            'exercise_id' => 'required|exists:exercises,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Vérifier si l'association existe déjà
        if ($workout->exercises()->where('exercise_id', $request->input('exercise_id'))->exists()) {
            return response()->json(['error' => 'Exercise already attached to this workout.'], 400);
        }

        $workout->exercises()->attach($request->input('exercise_id'));

        return response()->json(['message' => 'Exercise attached successfully.'], 201);
    }



    /**
     * Detach an exercise from a workout.
     */
    public function destroy(Workout $workout, Exercise $exercise)
    {
       // Vérifier si l'association existe avant de détacher
        if (!$workout->exercises()->where('exercise_id', $exercise->id)->exists()) {
            return response()->json(['error' => 'Exercise is not attached to this workout.'], 400);
        }
        $workout->exercises()->detach($exercise->id);
        return response()->json(null, 204);
    }
}