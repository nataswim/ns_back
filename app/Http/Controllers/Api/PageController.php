<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * 🇬🇧 Display a listing of the resource.
     * 🇫🇷 Afficher la liste des pages.
     */
    public function index()
    {
        $pages = Page::all();
        return response()->json($pages, 200);
    }

    /**
     * 🇬🇧 Store a newly created resource in storage.
     * 🇫🇷 Enregistrer une nouvelle page dans la base de données.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'content' => 'required', // 🇬🇧 Content is required / 🇫🇷 Le contenu est obligatoire
            'page_category' => 'nullable|max:255', // 🇬🇧 Optional category / 🇫🇷 Catégorie facultative
            'upload_id' => 'nullable|exists:uploads,id', // 🇬🇧 Must reference a valid upload / 🇫🇷 Doit référencer un fichier uploadé valide
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $page = Page::create($request->validated());
        return response()->json($page, 201);
    }

    /**
     * 🇬🇧 Display the specified resource.
     * 🇫🇷 Afficher une page spécifique.
     */
    public function show(Page $page)
    {
        return response()->json($page, 200);
    }

    /**
     * 🇬🇧 Update the specified resource in storage.
     * 🇫🇷 Mettre à jour une page existante.
     */
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255', // 🇬🇧 Title is required / 🇫🇷 Le titre est obligatoire
            'content' => 'required', // 🇬🇧 Content is required / 🇫🇷 Le contenu est obligatoire
            'page_category' => 'nullable|max:255', // 🇬🇧 Optional category / 🇫🇷 Catégorie facultative
            'upload_id' => 'nullable|exists:uploads,id', // 🇬🇧 Must reference a valid upload / 🇫🇷 Doit référencer un fichier uploadé valide
            'user_id' => 'required|exists:users,id', // 🇬🇧 Must reference a valid user / 🇫🇷 Doit référencer un utilisateur valide
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $page->update($request->validated());
        return response()->json($page, 200);
    }

    /**
     * 🇬🇧 Remove the specified resource from storage.
     * 🇫🇷 Supprimer une page spécifique de la base de données.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(null, 204);
    }
}
