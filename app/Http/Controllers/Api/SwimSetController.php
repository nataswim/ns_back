<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SwimSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SwimSetController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     * 🇫🇷 Afficher la liste des séries de natation.
     */
    public function index()
    {
        $swimSets = SwimSet::all();
        return response()->json($swimSets, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     * 🇫🇷 Enregistrer une nouvelle série de natation dans la base de données.
     */
    public function store(Request $request)
    {
        // 🇬🇧 Validate the request data
        // 🇫🇷 Valider les données de la requête
        $validator = Validator::make($request->all(), [
            'workout_id' => 'nullable|exists:workouts,id', // 🇬🇧 Must reference a valid workout / 🇫🇷 Doit référencer une séance valide
            'exercise_id' => 'nullable|exists:exercises,id', // 🇬🇧 Must reference a valid exercise / 🇫🇷 Doit référencer un exercice valide
            'set_distance' => 'nullable|integer', // 🇬🇧 Distance must be an integer / 🇫🇷 La distance doit être un entier
            'set_repetition' => 'nullable|integer', // 🇬🇧 Repetitions must be an integer / 🇫🇷 Le nombre de répétitions doit être un entier
            'rest_time' => 'nullable|integer', // 🇬🇧 Rest time must be an integer / 🇫🇷 Le temps de repos doit être un entier
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $swimSet = SwimSet::create($request->validated());
        return response()->json($swimSet, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     * 🇫🇷 Afficher une série de natation spécifique.
     */
    public function show(SwimSet $swimSet)
    {
        return response()->json($swimSet, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     * 🇫🇷 Mettre à jour une série de natation existante.
     */
    public function update(Request $request, SwimSet $swimSet)
    {
        // 🇬🇧 Validate the request data
        // 🇫🇷 Valider les données de la requête
        $validator = Validator::make($request->all(), [
            'workout_id' => 'nullable|exists:workouts,id', // 🇬🇧 Must reference a valid workout / 🇫🇷 Doit référencer une séance valide
            'exercise_id' => 'nullable|exists:exercises,id', // 🇬🇧 Must reference a valid exercise / 🇫🇷 Doit référencer un exercice valide
            'set_distance' => 'nullable|integer', // 🇬🇧 Distance must be an integer / 🇫🇷 La distance doit être un entier
            'set_repetition' => 'nullable|integer', // 🇬🇧 Repetitions must be an integer / 🇫🇷 Le nombre de répétitions doit être un entier
            'rest_time' => 'nullable|integer', // 🇬🇧 Rest time must be an integer / 🇫🇷 Le temps de repos doit être un entier
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $swimSet->update($request->validated());
        return response()->json($swimSet, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     * 🇫🇷 Supprimer une série de natation spécifique de la base de données.
     */
    public function destroy(SwimSet $swimSet)
    {
        $swimSet->delete();
        return response()->json(null, 204);
    }
}
