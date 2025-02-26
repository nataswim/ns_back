<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\User; // Importez le modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Pour la gestion des fichiers

class UploadController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     */
    public function index()
    {
        $uploads = Upload::all();
        return response()->json($uploads, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filename' => 'required|max:255', // Peut-être pas nécessaire si géré automatiquement
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Exemple de types de fichiers
            'type' => 'nullable|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads'); // Enregistrement dans storage/app/uploads

            $upload = Upload::create([
                'filename' => $file->getClientOriginalName(), // Ou un nom généré
                'path' => $path,
                'type' => $request->input('type'),
                'user_id' => $request->input('user_id'),
            ]);

            return response()->json($upload, 201);
        }

        return response()->json(['error' => 'No file uploaded'], 400); // Si aucun fichier n'est présent
    }

    /**
     * 🇬🇧 Display the specified resource.
     */
    public function show(Upload $upload)
    {
        return response()->json($upload, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        $validator = Validator::make($request->all(), [
            'filename' => 'required|max:255',
            'type' => 'nullable|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $upload->update([
            'filename' => $request->input('filename'),
            'type' => $request->input('type'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json($upload, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        // Supprimer le fichier physique
        Storage::delete($upload->path);
        $upload->delete();
        return response()->json(null, 204);
    }

    /**
     * 🇬🇧 Get uploads by user.
     */
    public function getUserUploads(User $user)
    {
        $uploads = $user->uploads; // Utiliser la relation définie dans le modèle User
        return response()->json($uploads, 200);
    }
}