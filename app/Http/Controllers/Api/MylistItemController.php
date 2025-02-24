<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mylist;
use App\Models\MylistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MylistItemController extends Controller
{
    /**
     * Display a listing of the items for a given mylist.
     */
    public function index(Mylist $mylist)
    {
        return response()->json($mylist->mylistItems, 200);
    }

    /**
     * Store a new item in a given mylist.
     */
    public function store(Request $request, Mylist $mylist)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',  // Validation de l'ID
            'item_type' => 'required|string|max:255', // Validation du type
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $itemType = $request->input('item_type');
        $itemId = $request->input('item_id');

        // Vérifier si l'item existe bien en fonction de son type
        switch ($itemType) {
            case 'exercise':
                $item = \App\Models\Exercise::find($itemId);
                break;
            case 'workout':
                $item = \App\Models\Workout::find($itemId);
                break;
            case 'plan':
                $item = \App\Models\Plan::find($itemId);
                break;
            default:
                return response()->json(['error' => 'Invalid item type.'], 400);
        }

         if (!$item) {
            return response()->json(['error' => 'Item not found.'], 404);
        }


        $mylistItem = new MylistItem();
        $mylistItem->mylist_id = $mylist->id;
        $mylistItem->item_id = $itemId;
        $mylistItem->item_type = $itemType;
        $mylistItem->save();


        return response()->json($mylistItem, 201);
    }

    /**
     * Remove an item from a given mylist.
     */
    public function destroy(Mylist $mylist, MylistItem $mylistItem)
    {

        // Vérifier que l'item appartient bien à la liste
        if ($mylistItem->mylist_id !== $mylist->id) {
            return response()->json(['error' => 'Item does not belong to this list.'], 400);
        }
        $mylistItem->delete();
        return response()->json(null, 204);
    }
}