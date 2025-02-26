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
     */
    public function index()
    {
        $workouts = Workout::all();
        return response()->json($workouts, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'workout_category' => 'nullable|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $workout = Workout::create($request->validated());
        return response()->json($workout, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     */
    public function show(Workout $workout)
    {
        return response()->json($workout, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'workout_category' => 'nullable|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $workout->update($request->validated());
        return response()->json($workout, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();
        return response()->json(null, 204);
    }
}