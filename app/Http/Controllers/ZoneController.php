<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    /**
     * Display a listing of the zones
     */

    public function index()
    {
        $zones = Zona::all();
        $incidencies = Incidencia::all();
        return view('zones.index', ['zones' => $zones], ['incidencies' => $incidencies]);
    }


    /**
     * Show the form for ceating a new zone
     */


    public function create()
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        return view('zones.create');
    }


    /**
     * Store a newly created zone in db
     */


    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        $validatedData = $request->validate([
            'Nom' => 'required|max:100',
            'Descripcio' => 'required',
            'Latitude' => [
                'required',
                'regex:/^\d{1,2}(\.\d{1,8})?$/'
            ],
            'Longitude' => [
                'required',
                'regex:/^\d{1,3}(\.\d{1,8})?$/'
            ],
        ]);

        $zone = Zona::create($validatedData);

        return redirect()->route('zones.index')->with('success', 'Zone created successfully');
    }

    /**
     * Display the specified zone
     */


    public function show(Zona $zone)
    {
        $this->authorize('view', $zone);

        return view('zones.show', ['zone' => $zone]);
    }

    /**
     * Show the form for editing the specified zone
     */


    public function edit(Zona $zone)
    {
        $this->authorize('update', $zone);

        return view('zones.edit', ['zone' => $zone]);
    }

    /**
     * Update the specified zone in db
     */


    public function update(Request $request, Zona $zone)
    {
        $this->authorize('update', $zone);

        $validatedData = $request->validate([
            'Nom' => 'required|max:255',
            'Descripcio' => 'required',
        ]);

        $zone->update($validatedData);

        return redirect()->route('zones.index')->with('success', 'Zone updated successfully');

    }

    /**
     * Remove the specified zone from db
     */


    public function destroy(Zona $zone)
    {
        $this->authorize('delete', $zone);

        $zone->delete();

        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully');
    }

}
