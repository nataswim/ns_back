<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mylists = Mylist::all();
        return response()->json($mylists, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $mylist = Mylist::create($request->validated());
        return response()->json($mylist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mylist $mylist)
    {
        return response()->json($mylist, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mylist $mylist)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $mylist->update($request->validated());
        return response()->json($mylist, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mylist $mylist)
    {
        $mylist->delete();
        return response()->json(null, 204);
    }
}