<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SwimSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SwimSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $swimSets = SwimSet::all();
        return response()->json($swimSets, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'workout_id' => 'nullable|exists:workouts,id',
            'exercise_id' => 'nullable|exists:exercises,id',
            'set_distance' => 'nullable|integer',
            'set_repetition' => 'nullable|integer',
            'rest_time' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $swimSet = SwimSet::create($request->validated());
        return response()->json($swimSet, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SwimSet $swimSet)
    {
        return response()->json($swimSet, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SwimSet $swimSet)
    {
        $validator = Validator::make($request->all(), [
            'workout_id' => 'nullable|exists:workouts,id',
            'exercise_id' => 'nullable|exists:exercises,id',
            'set_distance' => 'nullable|integer',
            'set_repetition' => 'nullable|integer',
            'rest_time' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $swimSet->update($request->validated());
        return response()->json($swimSet, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SwimSet $swimSet)
    {
        $swimSet->delete();
        return response()->json(null, 204);
    }
}