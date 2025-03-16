<?php

namespace App\Http\Controllers;

use App\Models\Itineraire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItineraireController extends Controller
{
    public function index()
    {
        return Itineraire::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'categorie' => 'required',
            'duree' => 'required',
            'image' => 'required',
            'destinations' => 'required|array',
            'destinations.*.name' => 'required|string',
            'destinations.*.lodging' => 'nullable|string',
            'destinations.*.places_to_visit' => 'nullable|array',
        ]);

        $itinerary = Auth::user()->itineraries()->create($validated);

        foreach ($validated['destinations'] as $destinationData) {
            $itinerary->destinations()->create($destinationData);
        }

        return response([
            'message' => 'success'
        ], 201);
    }

    public function show($id)
    {
        $itineraire = Itineraire::with('destinations')->find($id);

        if (!$itineraire) {
            return response()->json([
                'message' => "Itinerary not found!"
            ], 404);
        }

        return response()->json($itineraire);
    }

    public function filter(Request $request)
    {
        $query = Itineraire::query();

        if ($request->has('categorie')) {
            $query->where('categorie', 'ILIKE', $request->categorie);
        }

        $itineraire = $query->get();

        if ($itineraire->isEmpty()) {
            return response()->json([
                'message' => 'There is no itinerary with this category!'
            ], 404);
        }

        return response()->json($itineraire);
    }

    public function update(Request $request, $id)
    {
        $itineraire = Itineraire::find($id);

        if (!$itineraire) {
            return response()->json([
                'message' => "Itinerary not found!"
            ], 404);
        }

        if (Auth::id() != $itineraire->user_id) {
            return response()->json([
                'message' => "You are not authorized to edit this itinerary!"
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'categorie' => 'string',
            'duree' => 'integer|min:1', // Correction ici
            'image' => 'string|nullable',
        ]);

        $itineraire->update($validated);

        return response()->json([
            'message' => 'Itinerary updated successfully!',
            'itinerary' => $itineraire
        ], 200);
    }

    public function destroy(string $id)
    {
        $itineraire = Itineraire::find($id);

        if (!$itineraire) {
            return response()->json([
                'message' => "Itinerary not found!"
            ], 404);
        }

        if (Auth::id() != $itineraire->user_id) {
            return response()->json([
                'message' => "You are not authorized to delete this itinerary!"
            ], 403);
        }

        $itineraire->delete();

        return response()->json([
            'message' => 'Itinerary deleted successfully!'
        ], 200);
    }

    public function search($categorie)
    {
        $itineraires = Itineraire::where('categorie', 'like', '%'.$categorie.'%')->with('destinations')->get();

        return response()->json($itineraires);
    }
}
