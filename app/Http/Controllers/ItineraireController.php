<?php

namespace App\Http\Controllers;

use App\Models\Itineraire;
use Illuminate\Http\Request;

class ItineraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Itineraire::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categorie' => 'required',
            'duree' => 'required',
            'image' => 'required',
        ]);

        return Itineraire::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Itineraire::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itineraire = Itineraire::find($id);
        $itineraire->update($request->all());
        return $itineraire;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Search for a name.
     */
    public function search($categorie)
    {
        return Itineraire::where('categorie', 'like', '%'.$categorie.'%')->get();
    }
    



}
 