<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function store(Request $request, $itineraryId)
    {
        $itinerary = itinerary::where('user_id', Auth::id())->find($itineraryId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lodging' => 'nullable|string',
            'places_to_visit' => 'nullable|array',
        ]);

        $destination = $itinerary->destinations()->create($validated);

        return response()->json($destination, 201);
    }
}
