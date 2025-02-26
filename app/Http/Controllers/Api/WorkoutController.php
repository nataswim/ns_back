<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     * 🇫🇷 Afficher la liste des séances d'entraînement.
     */
    public function index()
    {
        $workouts = Workout::all();
        return response()->json($workouts, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     * 🇫🇷 Enregistrer une nouvelle séance d'entraînement dans la base de données.
     */
    public function store(Request $request)
    {
        // 🇬🇧 Validate the request data
        // 🇫🇷 Valider les données de la requête
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'description' => 'nullable', // 🇬🇧 Description is optional / 🇫🇷 La description est facultative
            'workout_category' => 'nullable|max:255', // 🇬🇧 Category is optional / 🇫🇷 La catégorie est facultative
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $workout = Workout::create($request->validated());
        return response()->json($workout, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     * 🇫🇷 Afficher une séance d'entraînement spécifique.
     */
    public function show(Workout $workout)
    {
        return response()->json($workout, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     * 🇫🇷 Mettre à jour une séance d'entraînement existante.
     */
    public function update(Request $request, Workout $workout)
    {
        // 🇬🇧 Validate the update request
        // 🇫🇷 Valider la requête de mise à jour
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'description' => 'nullable', // 🇬🇧 Description is optional / 🇫🇷 La description est facultative
            'workout_category' => 'nullable|max:255', // 🇬🇧 Category is optional / 🇫🇷 La catégorie est facultative
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $workout->update($request->validated());
        return response()->json($workout, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     * 🇫🇷 Supprimer une séance d'entraînement spécifique de la base de données.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();
        return response()->json(null, 204);
    }
}
