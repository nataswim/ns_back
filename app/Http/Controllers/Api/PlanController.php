<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     * 🇫🇷 Afficher la liste des plans d'entraînement.
     */
    public function index()
    {
        $plans = Plan::all();
        return response()->json($plans, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     * 🇫🇷 Enregistrer un nouveau plan d'entraînement dans la base de données.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'description' => 'nullable', // 🇬🇧 Description is optional / 🇫🇷 La description est facultative
            'plan_category' => 'nullable|max:255', // 🇬🇧 Category is optional / 🇫🇷 La catégorie est facultative
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $plan = Plan::create($request->validated());
        return response()->json($plan, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     * 🇫🇷 Afficher un plan d'entraînement spécifique.
     */
    public function show(Plan $plan)
    {
        return response()->json($plan, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     * 🇫🇷 Mettre à jour un plan d'entraînement existant.
     */
    public function update(Request $request, Plan $plan)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'description' => 'nullable', // 🇬🇧 Description is optional / 🇫🇷 La description est facultative
            'plan_category' => 'nullable|max:255', // 🇬🇧 Category is optional / 🇫🇷 La catégorie est facultative
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $plan->update($request->validated());
        return response()->json($plan, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     * 🇫🇷 Supprimer un plan d'entraînement spécifique de la base de données.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(null, 204);
    }
}
