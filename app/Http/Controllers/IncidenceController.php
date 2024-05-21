<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;

class IncidenceController extends Controller
{
    /**
     * Display a listing of the incidences
     */

    public function index()
    {
        $incident = Incidencia::all();
        return view('incidencies.index', ['incidencies' => $incident]);
    }

    /**
     * Show the form for creating a new incidence
     */
    public function create()
    {
        return view('incidencies.create');
    }

    /**
     * Store a newly created incidence in db
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nom' => 'required|max:150',
            'Descripcio' => 'required|max:500',
            'Estat' => 'required',
            'Prioritat' => 'required',
            //'Zona' => 'required',
            //'imatge' => 'required|image',
            'Rol_assignat' => 'required',
        ]);
        $incident = new Incidencia($validatedData);
        //$incident->Usuari_denunciant = Auth::id();
        $incident->Data = now();
        // if ($request->hasFile('image')) {
        //     $incident->image = $request->file('image')->store('public/incidences');
        // }
        $incident->save();

        return redirect()->Route('incidences.index')->with('success', 'Incidence created successfully');

    }

    /**
     * Display the specified incidence
     */

    public function show(Incidencia $incidence)
    {

        $incident = Incidencia::all();
        return view('incidencies.index', ['incidencies' => $incident]);
    }


    /**
     * Show the form for editing specified incidence 
     */


    public function edit(Incidencia $incidence)
    {
        return view('incidencies.edit', ['incidencia' => $incidence]);
    }


    /**
     * Update the specified incidence in storage
     */


    public function update(Request $request, Incidencia $incidence)
    {

        $validatedData = $request->validate([
            'Nom' => 'required|max:150',
            'Descripcio' => 'required|max:500',
            'Estat' => 'required',
            'Prioritat' => 'required',
            //'Zona' => 'required',
            //'imatge' => 'required|image',
            'Rol_assignat' => 'required',
        ]);


        $incidence->update($validatedData);

        return redirect()->route('incidences.index')->with('success', 'Incidence updated successfully.');
    }


    /**
     * Remove the specified incidence in db
     */


    public function destroy(Incidencia $incidence)
    {
        $incidence->delete();

        return redirect()->route('incidences.index')->with('success', 'Incidence deleted successfully.');
    }

}
