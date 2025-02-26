<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // Importez le modèle Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Pour hasher le mot de passe

class UserController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'first_name' => 'nullable|max:255',
            'last_name' => 'nullable|max:255',
            'role_id' => 'nullable|exists:roles,id', // Valider l'existence du rôle
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hasher le mot de passe
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'role_id' => $request->input('role_id'),
        ]);

        return response()->json($user, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'first_name' => 'nullable|max:255',
            'last_name' => 'nullable|max:255',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'role_id' => $request->input('role_id'),
        ]);

        // Gérer la modification du mot de passe si fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        return response()->json($user, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    /**
     * 🇬🇧 Get users by role.
     */
    public function getUsersByRole(Role $role)
    {
        $users = $role->users; // Utiliser la relation définie dans le modèle Role
        return response()->json($users, 200);
    }
}