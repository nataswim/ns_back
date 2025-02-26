<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     * 🇫🇷 Afficher la liste des exercices.
     */

    public function index()
    {
        $exercises = Exercise::all();
        return response()->json($exercises, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     * 🇫🇷 Enregistrer une nouvelle ressource dans la base de données
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'exercise_level' => 'nullable|max:255',
            'exercise_category' => 'nullable|max:255',
            'upload_id' => 'nullable|exists:uploads,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $exercise = Exercise::create($request->validated());
        return response()->json($exercise, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     * 🇫🇷 Afficher une ressource spécifique.
     */
    public function show(Exercise $exercise)
    {
        return response()->json($exercise, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     * 🇫🇷 Mettre à jour une ressource existante
     */
    public function update(Request $request, Exercise $exercise)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'exercise_level' => 'nullable|max:255',
            'exercise_category' => 'nullable|max:255',
            'upload_id' => 'nullable|exists:uploads,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $exercise->update($request->validated());
        return response()->json($exercise, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     * 🇫🇷 Supprimer une ressource spécifique de la base de données.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->json(null, 204);
    }
}